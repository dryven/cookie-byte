# Changelog

## [v1.1.5] - 2023-03-15

### Added

* Let users specify link_collections for bards

### Changed

* Remove bard text align options, as they do not work for addons

## [v1.1.4] - 2023-02-21

### Changed

* **Control Panel**: Make modal description a bard field
* **Control Panel**: Fix typo in modal position variables
* Add update scripts to migrate modal_description and modal position variables

## [v1.1.3] - 2023-02-21

### Fixed

* **Cookie Cover**: Make script tags executable in a cookie cover

## [v1.1.2] - 2023-02-15

### Changed

* **Cookie Cover**: Make the HTML snippet of a cookie cover be added before the cover element without a div surrounding it

## [v1.1.1] - 2023-02-10

### Fixed

* **Cookie Cover**: Make cookie covers tag compatible with Laravel versions before 9.x

## [v1.1.0] - 2023-02-10

### Added

* **Cookie Cover**: Add a slot, which contents are hidden as long as its cookie categories haven't been accepted
* **Control Panel**: Make the handles of cookie categories and cookie covers required and only consist of alpha characters
* **Control Panel**: Make it possible to change the configuration file identifier from locale to handle, so it's possible to save different configs even though two multisites have the same locale
* **Fields**: Add fieldtypes for cookie categories' and cookie covers' handles
* Add full plug-and-play support for Statamic static caching
* Add support for Statamic 3.4+

### Changed

* **Cookie Cover**: Make the cookie cover be fully controlled by JavaScript instead of antlers
* **Cookie Modal**: Make the modal be marked as shown when it was closed by a cookie cover
* **Internal**: Refactor CookieCovers to CookieCover, to separate logic of all covers and one cover
* **Internal**: Change CookieConsent.cookieCover to CookieConsent.cookieCovers
* **Internal**: Deprecate CookieCovers.show, CookieCovers.hide and CookieCovers.getCoversByHandle
* **Internal**: Improve code documentation and typing

### Fixed

* **Cookie Cover**: Fix a bug that caused the background image to be invisible in some instances
* **Cookie Cover**: Fix style bug, that caused the accept button to be hardly visible by default
* **Control Panel**: Fix a bug that causes the cookie categories to be invalid even though it was filled correctly (More info: Statamic seems to add a ghost item while pre-processing the field, which is not visible but fails validation)

## [v1.0.17] - 2022-12-15

### Changed

* Hide cookie category tooltip when description is empty
* Fix categories not being shown after install without saving once

## [v1.0.16] - 2022-06-28

### Added

* Make config directory path an configurable variable

## [v1.0.15] - 2022-06-14

### Added

* Make Cookie Byte work with static caching

### Changed

* Some minor code cleanup
* Make statically cached sites update, when the CookieByte CP configuration is saved

## [v1.0.14] - 2022-03-16

### Fixed

* Fix error when there are multiple asset containers defined

## [v1.0.13] - 2021-11-23

### Fixed

* Fix bug that prevents from saving the addons' configuration

## [v1.0.12] - 2021-11-22

### Fixed

* Fix bug that falsely set the consents into the browsers' cookies after accepting cookies through a cookie cover

## [v1.0.9-v1.0.11] - 2021-11-04

### Fixed

* Fix bug that prevents the output of the javascript code which should be executed when a cookie category is consented to
* Removed obsolete code
* Fix bug that always shows the default site config in CP

## [v1.0.8] - 2021-11-02

### Fixed

* Change stylesheet and javascript paths from relative to absolute

## [v1.0.7] - 2021-08-17

### Fixed

* Bug that ignored unchecked checkboxes in the cookie modal when the settings were changed afterwards #3

## [v1.0.6] - 2021-08-12

### Fixed

* Cookie covers with the same handle on one page are now collectively closed #2
  * **Warning**: Make sure to replace all instances of '#ddmcc-button-accept' to '.ddmcc-button-accept' in your custom styles, else the buttons of the covers might not be styled anymore.

## [v1.0.5] - 2021-08-11

### Added

* Cookie covers now close as soon as their cookie category or cookie categories have been consented to from elsewhere
* The cookie modal closes as soon as all cookie categories have been consentend to from elsewhere

### Fixed

* All cookies covers of the same cookie category are now closed at the same time #2

## [v1.0.4] - 2021-07-26

### Fixed

* Added check if a background image was set on a cookie cover
* Fixed possible error 'Cannot render an array variable as a string: {{ bg_image }}'

## [v1.0.3] - 2021-05-24

### Fixed

* Fixed permission settings

## [v1.0.2] - 2021-05-10

### Fixed

* Fixed invalid expire date in cookies

## [v1.0.1] - 2021-05-05

### Added

* Added prevention for running a callback multiple times.
* Added ``autorun`` option in ``CookieConsent`` class for controlling if
  callbacks are automatically run with initializing the class.

---

## [v1.0.0] - 2021-04-13

### Added

* **Cookie modal**
    * customizable text
    * customizable position
    * customizable background
    * checkbox for each cookie category
    * two buttons: "Select all" and "Confirm selection"
* **Cookie content cover**
    * customizable text
    * customizable background image
* **JavaScript**
    * Object ``CookieConsent``: consent & callback management
        * Method ``hasConsent(cookieCategories)`` for checking consent of cookie category/categories
        * Method ``consent(cookieCategories)`` for consenting to cookie category/categories
        * Method ``registerCallback(cookieCategory, callback)`` Registering a callback function after consenting to a
          cookie category
        * Method ``unregisterCallback(cookieCategories)`` unregistering callback functions
        * Method ``runCallback(cookieCategories)`` runs the callback if the cookie category/categories have already been
          consented to
        * Method ``runCallbacks()`` runns callbacks of all consented cookie categories
    * Object ``CookieModal``: modal initialization
        * Method ``show()`` Makes the modal appear
        * Method ``hide()`` Makes the modal disappear
    * Object ``CookieCovers``: initialization of content covers
        * Method ``getCoverByHandle(handle)`` Returns content cover element by handle
        * Method ``show(cover)`` Makes the given content cover appear
        * Method ``hide(cover)`` Makes the given content cover disappear
* **CSS**
    * Pre-defined styles for modal and content covers
    * Pre-defined styles for checkboxes, buttons and tooltips
* **Tags**
    * Tags for checking consent, the modal and the content covers
* **Control Panel**
    * 3 Tabs for customizing the addon, the modal and the content covers
    * English and German translation files
    * English and German default config files
    * Icon for navigation item
