# Change Log

All notable changes to this project will be documented in this file. This
project adheres to [Semantic Versioning 2.0.0][semver]. Any violations of this
scheme are considered to be bugs.

[semver]: http://semver.org/spec/v2.0.0.html

## [0.2.0][0.2.0] - 2016-04-27

### Added

- Added support for creating plans.
- Added support for querying singular and lists of plans.
- Added support for creating, updating and deleting promo codes.
- Added support for querying singular and lists of promo codes.
- Added support for cancelling subscriptions.
- Added support for querying singular and lists of subscriptions.
- Added support for querying singular transaction tokens.

### Changed

- Changed models to use properties instead of public instance variables. This
  should not affect any external functionality but does rely on the `__get`
  magic method added in PHP 5.0.

## 0.1.0 - 2016-04-12

### Added

- Initial version.

[0.2.0]: https://github.com/accepton/accepton-php/compare/v0.1.0...v0.2.0
