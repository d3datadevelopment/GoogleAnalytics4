# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.16.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.15.1...1.16.0) - 2024-04-11
### Added
- ( Google ) Server-Side tagging usability

## [1.15.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.15.0...1.15.1) - 2024-04-11
### Fixed
- false processing of template during missing necessary-component

## [1.15.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.14.0...1.15.0) - 2024-01-25
### Fixed
- missing Component-ArticleDetails extension, missing ManufacturerListController extension

## [1.14.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.13.0...1.14.0) - 2024-01-03
### Added
- add_to_cart Event to several new shop-pages (landing-page, Account, category article-list, start)
- PHPStan code-cleanup
### Changed
- template structure
- code cleanup

## [1.13.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.12.0...1.13.0) - 2023-09-13
### Added
- extended Docs
### Changed
- control-param name
- control-param function
- adjusted check for set control-param
- consentmanager-script-adjustments

## [1.12.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.11.1...1.12.0) - 2023-09-07
### Added
- cookiebot functionality

## [1.11.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.11.0...1.11.1) - 2023-08-17
### Fixed
- metadata class entry

## [1.11.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.10.0...1.11.0) - 2023-08-16
### Added
- remove_from_cart
- auto debug_mode setter
- manufacturer extension for breadcrumb
### Changed
- general template cleanup

## [1.10.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.9.0...1.10.0) - 2023-06-27
### Added
- Following Entries to dedicated event-templates
  - coupon
  - paymentType
  - item_list_name
  - item_category
- Method to get the in order used Payment-Name
- Method to get the current Article Category
### Changed
- cookieManager handling
- general template cleanup
- renaming the template to a more intuitive name

## [1.9.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.8.0...1.9.0) - 2023-06-19
### Changed
- add_to_cart event template-structure

## [1.8.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.7.0...1.8.0) - 2023-05-31
### Fixed
- bug in explicit manager selection

## [1.7.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.6.0...1.7.0) - 2023-05-31
### Added
- extended call to read the technical documentation
### Changed
- block-extension for view_item_list
- way of getting list-articles in view_item_list

## [1.6.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.5.0...1.6.0) - 2023-05-30
### Added
- possibility to choose between consentmanager && usercentrics
- position to block extension
### Changed
- genuine code cleanup
- usercentrics includation script

## [1.5.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.4.0...1.5.0) - 2023-05-23
### Added
- additional settings to explicitly indicate that consentmanager is used
### Fixed
- unnecessary converting of int to str
- missing PriceObject-bug
### Changed
- genuine code cleanup

## [1.4.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.3.1...1.4.0) - 2023-05-02
### Added
- "OXID Cookie Management powered by usercentrics" compatibility
- usercentrics defined script attributes
- cookie-manager evaluation
### Changed
- genuine clean up of base-js-files

## [1.3.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.2.1...1.3.1) - 2023-03-17
### Added
- Aggrosoft-Cookie-Consent compatibility
### Fixed
- wrong function for pageview on thankyou page

## [1.2.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.2...1.2.1) - 2023-02-22
### Fixed
- price formatting in view_cart

## [1.2](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.1...1.2) - 2023-02-01
### Added
- own cookie-check-handler

## [1.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.0...1.1) - 2023-01-27
### Added
- block section for add_to_basket js
- template block order positions

### Changed
- switched price formatting

## [1.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.0...1.0) - 2023-01-20
### Added
- publication of app features