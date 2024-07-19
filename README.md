PHP Debian Blitz
================

About
-----

This code repository contains [PHP Blitz](https://github.com/alexeyrybak/blitz) software with some additional scripts and files, required to build Debian packages. 

Maintainer of original software: [Alexey Rybak](https://github.com/alexeyrybak)

Supported versions:

* PHP 8.3 - Blitz 0.10.6 + unreleased patches till 07.2024
* PHP 8.2 - Blitz 0.10.6 + unreleased patches till 07.2024
* PHP 8.1 - Blitz 0.10.6 + unreleased patches till 07.2024 + additional compatibility patch
* PHP 8.0 - Blitz 0.10.6 + unreleased patches till 07.2024 + additional compatibility patch
* PHP 7.4 - Blitz 0.10.4
* PHP 7.3 - Blitz 0.10.4
* PHP 7.2 - Blitz 0.10.4
* PHP 7.2 - Blitz 0.10.4
* PHP 7.1 - Blitz 0.10.4
* PHP 7.0 - Blitz 0.10.4
* PHP 5.6 - Blitz 0.9.1

Requirements
------------

* Debian-like Linux (Ubuntu for example)
* build-essential package and it depends
* dh-php package
* phpN.N-dev packages for needed PHP versions (where N.N means PHP version, 8.3, 7.4, etc.)

Install
--------

For detailed instruction how to build just see [.gitlab-ci.yml](.gitlab-ci.yml) manifest, it's simple.
