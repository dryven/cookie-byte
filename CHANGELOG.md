# Changelog

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
