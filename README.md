# tt-rss-one-click-mark

A [TT-RSS](https://tt-rss.org/) plugin that will add a one-click 'Mark as read' button on the toolbar.

### Installing the plugin

1. Clone this repo or just grab the [latest release](https://github.com/nneul/tt-rss-one-click-mark/releases/latest) and extract the `one_click_mark` folder into the `plugins.local` folder of ttrss
2. Enable in preferences

![Screenshot](https://github.com/nneul/tt-rss-one-click-mark/raw/main/screenshots/one_click_mark.png)

![Prefs Screenshot](https://github.com/nneul/tt-rss-one-click-mark/raw/main/screenshots/one_click_mark_prefs.png)

### Hiding the original button

1. Go to Preferences / Theme / Customize
2. Copy & paste this css: `#main-catchup-dropdown { display: none !important; }`
