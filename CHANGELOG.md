# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [unreleased](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.17.2...rel_2.x) - 2024-x

## [2.18.2](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.18.0...2.18.1) - 2024-06-25
### Fixed
- oe-console apply-configuration triggers on-activate and overwrites existing values

## [2.18.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.18.0...2.18.1) - 2024-06-04
### Fixed
- missing return statement, on null/ none

## [2.18.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.17.2...2.18.0) - 2024-06-03
### Added
- trait for generalized method
- new admin UI
- additional check for properly activated module
- admin headitem alternative
- usercentrips step/ option 2
- group CMP-Functionalities/ properties into own Model
- additional help texts, translations, explanations
- extended docs
- auto safe on first approach ga4 + cmp-mod
- onActivate/ onDeactivate
## Changed
- declare module settings consistency
- configParamGetter
- clear dead code
- template code upgrade
- lang text
- amount of save-buttons
- Usercentrics-Class constants and adjust global-module-code to it
- CMP-output in tpl
- clear code and adjust Naming
## Fixed
- false class-property declaration
- wrong to-save param
## Removed
- deprecated and obsolete module-settings
- false composer xml-excludation

## [2.17.2](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.17.1...2.17.2) - 2024-04-11
### Fixed
- error on missing necessary-component

## [2.17.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.17.0...2.17.1) - 2024-04-10
### Fixed
- second call of getGtmContainerId() ( returned false )

## [2.17.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.16.0...2.17.0) - 2024-04-10
### Added
- Google-Analytics default values
- default values switch ( admin module settings )
- translations
## Changed
- centralized metadata-id

## [2.16.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.15.0...2.16.0) - 2024-03-20
### Added
- ( Google ) Server-Side tagging usability

## [2.15.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.14.0...2.15.0) - 2024-02-05
### Fixed
- missing Component-ArticleDetails extension, missing ManufacturerListController extension

## [2.14.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.13.1...2.14.0) - 2023-01-22
### Added
- add_to_cart Event to several new shop-pages (landing-page, Account, category article-list, start)
- PHPStan code-cleanup
### Changed
- template structure
- code cleanup

## [2.13.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.13.0...2.13.1) - 2023-01-03
### Fixed
- error on array-count at zero entries

## [2.13.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.12.0...2.13.0) - 2023-09-13
### Added
- extended Docs
### Changed
- control-param name
- control-param function
- adjusted check for set control-param
- consentmanager-script-adjustments

## [2.12.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.11.1...2.12.0) - 2023-09-07
### Added
- cookiebot functionality

## [2.11.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.10.1...2.11.0) - 2023-08-23
### Added
- manufacturer extension
- working debug_mode
### Changed
- check for 'article has been removed'
- general template cleanup

## [2.10.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.10.0...2.10.1) - 2023-08-03
### Added
- missing param to identify the event

## [2.10.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.9.2...2.10.0) - 2023-08-02
### Added
- new Event "remove_from_cart"

## [2.9.2](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.9.1...2.9.2) - 2023-06-29
### Fixed
- wrong variable for category-object check

## [2.9.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.9.0...2.9.1) - 2023-06-27
### Fixed
- deny method call on no category

## [2.9.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.8.0...2.9.0) - 2023-06-27
### Added
- Cookiefirst usability

## [2.8.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.7.0...2.8.0) - 2023-06-23
### Added
- Method to get the in order used Payment-Name
- Method to get the current Article Category
- Following Entries to dedicated event-templates
  - coupon
  - paymentType
  - item_list_name
  - item_category
### Changed
- all used template-files have a more dedicated name
- general code cleanup

## [2.7.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.6.0...2.7.0) - 2023-06-19
### Changed
- add_to_cart event template-structure

## [2.6.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.5.0...2.6.0) - 2023-05-31
### Added
- add settings to explicit choose an external service (usercentrics/ consentmanager)
- position to block-extension
- extended instructions to check for in readme
### Fixed
- usercentrics script
- missing right articleList-getter
### Changed
- view_item_list-template block extension
- cookieManager handling
### Removed
- additional check for cookieManagerType

## [2.5.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.4.0...2.5.0) - 2023-05-23
### Added
- additional settings to explicitly indicate that consentmanager is used
### Fixed
- unnecessary converting of int to str
- missing PriceObject-bug
### Changed
- genuine code cleanup

## [2.4.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.3.3...2.4.0) - 2023-05-02
### Added
- "OXID Cookie Management powered by usercentrics" compatibility
- usercentrics defined script attributes
- cookie-manager evaluation
### Changed
- genuine clean up of base-js-files

## [2.3.3](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.3.2...2.3.3) - 2023-03-20
### Fixed
- metadata file path for view_item

## [2.3.2](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.2.2...2.3.2) - 2023-03-17
### Added
- Aggrosoft-Cookie-Consent compatibility
### Fixed
- wrong function for pageview on thankyou page
### Deleted
- unused files

## [2.2.2](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.2.1...2.2.2) - 2023-02-22
### Fixed
- price formatting in view_cart

## [2.2.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.1.1...2.2.1) - 2023-02-21
### Added
- cookie handling

## [2.1.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.1...2.1.1) - 2023-01-27
### Fixed
- add missing class import

## [2.1](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/2.0...2.1) - 2023-01-27
### Added
- block section for add_to_basket js
- template block order positions

## [2.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.1...2.0) - 2023-01-20
### Added
- using of ContainerFactory in ViewConfig

## [1.17.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.16.0...1.17.0) - 2024-04-11
### Added
- multilang translations
- GA4 consent-mode default values
### Changed
- metadataID centralized

## [1.16.0](https://git.d3data.de/D3Public/GoogleAnalytics4/compare/1.15.1...1.16.0) - 2024-04-11
### Added
- ( Google ) Server-Side tagging usability

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