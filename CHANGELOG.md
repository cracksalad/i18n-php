# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/nerou42/CLIParser/compare/v0.1.2...master)

### Added

- PHPCS to GitHub actions and composer scripts
- rector to GitHub actions and composer scripts
- This changelog

### Removed

- composer.lock from .gitignore
- Unnecessary stubs

### Fixed

- Psalm issues (missing Override attribute and @api annotation)


## [v0.1.2](https://github.com/nerou42/CLIParser/compare/v0.1.1...v0.1.2) - 2024-07-13

### Added

- Missing ext-intl dependency to composer.json

### Fixed

- Fix type safety issue in constructor occuring if passed `$directory` is not an existing path


## [v0.1.1](https://github.com/nerou42/CLIParser/releases/tag/v0.1.1) - 2023-08-25

### Added

- Basic i18n implementation
