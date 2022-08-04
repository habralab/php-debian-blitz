<?php

define( 'INDENT', ' ' );

$files = shell_exec(
	'git -C ' .	escapeshellarg( __DIR__ ) .
	' ls-tree --name-only -r 0.10.4-PHP7'
);

if ( !$files ) {
	fwrite( STDERR, "Error running git ls-tree\n" );
	exit( 1 );
}

$dirs = [];

foreach ( explode( "\n", $files ) as $file ) {
	if ( $file === '' ) {
		continue;
	}
	$parts = explode( '/', $file );
	$cursor =& $dirs;
	for ( $i = 0; $i < count( $parts ) - 1; $i++ ) {
		$part = $parts[$i];
		if ( substr( $part, 0, 1 ) === '.' ) {
			continue 2;
		}
		if ( !isset( $cursor[$part] ) ) {
			$cursor[$part] = [];
		}
		$cursor =& $cursor[$part];
	}
	$part = $parts[$i];
	if ( substr( $part, 0, 1 ) === '.' ) {
		continue;
	}
	if ( $part === 'package.xml' ) {
		continue;
	}
	$cursor['.'][] = $part;
}

echo INDENT . "<contents>\n";
writeDir( '', $dirs, INDENT . INDENT );
echo INDENT . "</contents>\n";

function writeFiles( $files, $indent ) {
	foreach ( $files as $file ) {
		$dotPos = strrpos( $file, '.' );
		$ext = $dotPos === false ? '' : substr( $file, $dotPos + 1 );

		if ( $ext === 'phpt' ) {
			$role = 'test';
		} elseif (
			$ext === 'c' ||
			$ext === 'h' ||
			$ext === 'cpp' ||
			$ext === 'hpp' ||
			$ext === 'w32' ||
			$ext === 'sh' ||
			$ext === 'ini'
		) {
			$role = 'src';
		} else {
			$role = 'doc';
		}
		echo "$indent<file name=\"" . htmlspecialchars( $file ) . "\" " .
			"role=\"" . htmlspecialchars( $role ) . "\"/>\n";
	}
}

function writeDir( $name, $contents, $indent ) {
	if ( $name === '' ) {
		$outName = '/';
	} else {
		$outName = $name;
	}
	echo "$indent<dir name=\"" . htmlspecialchars( $outName ) . "\">\n";
	foreach ( $contents as $name => $subdirOrFiles ) {
		if ( $name === '.' ) {
			writeFiles( $subdirOrFiles, $indent . INDENT,  );
		} else {
			writeDir( $name, $subdirOrFiles, $indent . INDENT );
		}
	}
	echo "$indent</dir>\n";
}
