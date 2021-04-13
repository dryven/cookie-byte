# Changelog

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
    * English translation files
    * English and German default config files
    * Icon for navigation item
