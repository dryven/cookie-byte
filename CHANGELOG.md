# Changelog

## [v1.0.0] - 2021-03-XX

### Added
* **Cookie modal**
  * customizable text
  * customizable position
  * customizable background
  * checkbox for each cookie class
  * two buttons: "Select all" and "Confirm selection"
* **Cookie cover**
  * customizable text
  * customizable background image
* **JavaScript**
  * Object ``CookieConsent``: consent & callback management
    * Method ``hasConsent(cookieClasses)`` for checking consent of cookie class(es)
    * Method ``consent(cookieClasses)`` for consenting to cookie class(es)
    * Method ``registerCallback(cookieClass, callback)`` Registering a callback
      function after consenting to a cookie class
    * Method ``unregisterCallback(cookieClasses)`` unregistering callback functions
    * Method ``runCallback(cookieClasses)`` runs the callback if the cookie class
      has already been consented to
    * Method ``runCallbacks()`` runns callbacks of all consented cookie classes
  * Object ``CookieModal``: modal initialization
    * Method ``show()`` Makes the modal appear
    * Method ``hide()`` Makes the modal disappear
  * Object ``CookieCovers``: covers initialization
    * Method ``getCoverByHandle(handle)`` Returns cover element by handle
    * Method ``show(cover)`` Makes the given cover appear
    * Method ``hide(cover)`` Makes the given cover disappear
* **CSS**
  * Pre-defined styles for modal and covers
  * Pre-defined styles for checkboxes, buttons and tooltips
* **Tags**
  * Tags for checking consent, the modal and the covers
* **Control Panel**
  * 3 Tabs for customizing the addon, the modal and the covers
  * English and German translation files
  * English and German default config files
  * Icon for navigation item
