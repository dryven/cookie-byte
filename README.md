<img src="https://raw.githubusercontent.com/ddm-studio/cookie-byte/main/resources/svg/cookie-byte.svg" width="45px" height="45px">

# Cookie Byte

[![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0%2B-FF269E)](https://statamic.com/)
[![GitHub release](https://img.shields.io/github/release/ddm-studio/cookie-byte.svg)](https://gitHub.com/ddm-studio/cookie-byte/releases/)

## Disclaimer

Please note that we have created the addon to the best of our knowledge, but due to the rapid developments around the
GDPR, we cannot guarantee full legal compliance and are not liable for violations of the GDPR and other privacy
policies. In case of doubt, please contact your legal advisor.

## Features

Cookie Byte is an important addon to make your website fit for the current privacy and cookie policies. In addition to
the usual cookie consent modal, in which users can selectively accept the desired cookies, the addon offers numerous
other features so that you no longer have to worry about cookies of any kind.

* **Control panel settings:** Change the addon's settings directly where you prefer to do it: In the control panel.
  Activate the addon, add cookie categories, remove a code snippet - rule over all cookies!
* **Code snippets and their cookies:** Code snippets are loaded on the website only when the user agrees to the cookies
  required for them - without reloading the website (so your analytics data won't be corrupted - yesss!).
* **Cookie content covers:** Some content must be hidden as long as the corresponding cookies have not been accepted,
  such as Google Maps embeds. For this we created cookie content covers (and because we can call the feature ccc
  internally).
  [Animated cookie content cover preview](https://raw.githubusercontent.com/ddm-studio/cookie-byte/main/repo/CookieCoverExample.gif)
* **Customisability:** The modal and the covers are completely customizable - change the text and position of the modal
  as you see fit.
* **Developer friendly:** To make your life easier, the addon comes with predefined styles and inline code. But rest
  assured: If you need more control, you can customize everything!

There are more amazing features coming: Take a look at our [Feature releases](README.md#future-features)!

## Documentation

For more information about how to use this addon see our
[documentation](DOCUMENTATION.md).

## Licensing

You can use the addon for free during development as long as you want, to see if it suits you and your website. As soon
as you fell in love with it and want to put it on your live production site, the addon needs licensing. Check out the
[Statamic Marketplace](https://statamic.com/addons/statamic/seo-pro) to learn more about that.

## Future features

In future releases you will see more awesome features like:

* **Second modal type:** We'll add a second modal to choose from, which features submenus and an opt-out which requires
  more steps - for our "I wish more users would accept the statistical cookies so we have more analytics data for our
  online-marketing" colleagues.
* **Consent records:** How many people have seen the modal? How many people have accepted? How many have bounced off? So
  many questions - soon we will provide the answers!
* **Geo-Targeting:** In many countries, the cookie modal does not need to be displayed at all. So why bother the users
  from these countries with it? Just exclude them with our geo-tracking.