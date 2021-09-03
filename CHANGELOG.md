# Change Log

All notable changes to this project will be documented in this file. This project adheres
to [Semantic Versioning] (http://semver.org/). For change log format,
use [Keep a Changelog] (http://keepachangelog.com/).

## [1.3.0] - 2021-09-03

### Changed

- Signature of `FlashBag::count(): int` for PHP 8.1
- Signature of `FlashBag::all(): array`

## [1.2.0] - 2020-05-11

### Added

- PHP 8 compatibility in `composer.json`

## [1.1.0] - 2020-03-11

### Added

- FlashBag::add() method accept arguments like sprintf() function

### Changed

- Enabled strict types
- Declare type in methods declarations
- Add coverage options in phpunit.xml.dist
- Throw Exception instead of PHP error if sessions are disabled
- Update .travis.yml to test PHP7.4snapshot instead of nightly (PHP8)

### Removed

- Remove composer.lock

## [1.0.0] - 2018-06-29

First version