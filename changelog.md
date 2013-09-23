# Changelog

## 3.3.4 (July 29th, 2013)

### Core Theme

* Fixes issues in Standard SEO with post titles containing international accents and symbols.
* Fixes issues in Standard SEO no bolding keywords when keywords are used multiple times.

### Change Set

**Modified**

* css/less/style.less
* functions.php
* js/admin.min.js
* lib/seo/js/dev/admin.js
* style.css

## 3.3.3 (July 19th, 2013)

### Core Theme

* Fixes special characters in post title causing Standard SEO to hang the browser.

### Change Set

**Modified**

* codekit-config.json
* css/less/style.less
* functions.php
* js/admin.min.js
* lib/seo/js/dev/admin.js
* style.css

## 3.3.2 (July 15th, 2013)

### Core Theme

* Fixes post meta description SEO highlighting.

### Change Set

**Modified**

* css/less/style.less
* functions.php
* js/admin.min.js
* lib/seo/js/admin.min.js
* lib/seo/js/dev/admin.js
* style.css

## 3.3.1 (June 28th, 2013)

### Core Theme

* Fixes invalid comments.
* Fixes image post format images not displaying in RSS.
* Fixes link post format stripping formatting.

### Change Set

**Modified**

* css/less/posts.less
* functions.php
* loop-link.php
* loop-video.php
* page.php
* style.css
* template-archives.php
* template-fullwidth.php
* template-sitemap.php

## 3.3 (June 25th, 2013)

### Core Theme

* Adds support for localization / translation files to be pulled from child theme instead of parent theme.
* Adds support for menu link relationship (XFN).
* Adds CodeKit enhancements for widgets and plugins.
* Adds support for advanced Google Analytics (see [Standard Advanced Google Analytics](https://github.com/eightbit/standard-plugins/tree/master/standard-advanced-google-analytics) plugin).
* Adds support for aside post format.
* Fixes H1 and H2 tags for static pages.
* Fixes quote post format styles.
* Fixes special characters in post titles breaking post editor functionality.
* Fixes missed localization / translation instances.
* Fixes header preview in admin.
* Fixes displaying SEO titles to follow WordPress best practices.
* Fixes SEO titles preview inconsistency.
* Removes legacy affiliate code.
* Removes gap below image post formats when there is no text.
* Removes border from images with a caption.
* Updates gravatar display code.
* Updates Twitter embeds to be fully responsive.
* Updates licensing and attribution.
* Updates Standard to require WordPress 3.4 or higher.
* Updates all admin scripts to load in a single file.
* Updates markup for readability, whitespace, and best practices.
* Updates color styles.
* Updates heading styles.
* Updates editor styles.
* Updates Google+ profile requirements.

### Archives Template

* Adds "All Pages" to archives.
* Adds pagination for large archives to increase performance.
* Removes "sticky" posts from showing up at the top of the archives and now falls in place chronologically.

### Activity Tabs Widget

* Fixes styling issues.

### Google Custom Search Widget

* Fixes typo.
* Updates request to get search results.

### Change Set

**Added**

* css/widgets-responsive.css
* js/admin/profiles.min.js
* js/dev/admin.profiles.js
* license.md
* loop-aside.php

**Removed**

* css/less/widgets-responsive.less
* js/admin.post.min.js
* js/dev/theme.js
* lib/activity/css/widget.css
* lib/google-custom-search/css/widget.css
* lib/influence/css/widget.css
* lib/personal-image/css/widget.css
* lib/standard-ad-125x125/css/widget.css
* lib/standard-ad-300x250/css/widget.css
* lib/standard-ad-billboard/css/widget.css

**Modified**

* 404.php
* attribution.md
* breadcrumbs.php
* codekit-config.json
* comments.php
* css/editor-style.css
* css/less/editor-style.less
* css/less/header.less
* css/less/pages.less
* css/less/posts.less
* css/less/style.less
* css/less/theme-responsive.less
* css/less/typography.less
* css/less/variables.less
* css/less/wigets.less
* css/theme-responsive.css
* footer.php
* functions.php
* header.php
* index.php
* js/admin.media-upload.min.js
* js/admin.min.js
* js/dev/admin.js
* js/dev/admin.header.js
* lang/standard.mo
* lang/standard.po
* lib/activity/css/less/widget.less
* lib/activity/css/widget.css
* lib/activity/plugin.php
* lib/google-custom-search/plugin.php
* lib/google-custom-search/views/admin.php
* lib/influence/plugin.php
* lib/personal-image/plugin.php
* lib/seo/js/dev/admin.js
* lib/seo/plugin.php
* lib/standard-ad-125x125/plugin.php
* lib/standard-ad-300x250/plugin.php
* lib/standard-ad-billboard/plugin.php
* lib/Standard_Nav_Walker.php
* loop.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* page.php
* page-offline-mode.php
* sidebar.php
* single.php
* social-networking.php
* style.css
* template-archives.php
* template-fullwidth.php
* template-sitemap.php














## 3.2.5 (March 6th, 2013)

### Archives Template

* Fixes special characters in post / page title breaking editor functionality.
* Fixes post-level Standard SEO unresponsive browser issues.
* Fixes media uploads for custom post types.

### Change Set

**Modified**

* css/less/style.css
* functions.php
* js/admin.min.js
* lib/seo/js/admin.min.js
* lib/seo/js/dev/admin.js
* lib/seo/plugin.php
* style.css

## 3.2.4 (March 4th, 2013)

### Archives Template

* Fixes issues with `All Posts` list appearing out of order, containing duplicates, and including pages.

### Change Set

**Modified**

* css/less/style.less
* functions.php
* lang/standard.mo
* lang/standard.po
* style.css
* template-archives.php

## 3.2.3 (March 1st, 2013)

### Core Theme

* Fixes issues with not being able to hit `Enter` in the `Text` tab of the post editor.

### Change Set

**Modified**

* css/less/style.less
* functions.php
* js/admin.min.js
* js/dev/admin.js
* js/dev/admin.social-options.js
* lib/seo/js/dev/admin.js
* style.css

## 3.2.2 (March 1st, 2013)

### Core Theme

* Fixes issues with uploading / inserting images into posts and ads.

### Change Set

**Modified**

* css/less/stlye.less
* functions.php
* js/admin.min.js
* js/dev/admin.js
* js/dev/admin.media-upload.js
* style.css

## 3.2.1 (February 28st, 2013)

### Google Custom Search Widget

* Fixes search results coming back empty.

### Sitemap Template

* Fixes page template not being selectable.

### Change Set

**Modified**

* css/less/style.less
* functions.php
* js/admin.min.js
* js/dev/admin.template-sitemap.js
* lang/standard.mo
* lang/standard.po
* lib/google-custom-search/plugin.php
* style.css

## 3.2 (February 28st, 2013)

### Core Theme

* Adds support for Jetpack's Tiled Galleries.
* Adds support for Jetpack's Infinite Scroll.
* Adds support for Google Analytics speed tracking.
* Adds CodeKit enhancements.
* Adds support for WordPress 3.5.
* Adds cache-busting versioning to JavaScript and CSS files.
* Fixes VideoPress issues.
* Fixes navigation menu items not opening in new windows when specified.
* Fixes image alignment spacing.
* Fixes mobile footer widgets going clear to screen edge.
* Fixes mobile social icon alignment.
* Fixes tagline color inconsistencies in header preview.
* Fixes Google+ user profile issues when using WordPress SEO plugin.
* Fixes all known translation / localization issues.
* Fixes spacing issues in link post format.
* Fixes social icons typo.
* Fixes logo description typo.
* Fixes site icon description typo.
* Fixes comment policy template typo.
* Fixes media uploader placeholder text in Firefox.
* Fixes post metabox tables issues.
* Fixes author breadcrumb issues.
* Fixes iOS icon size.
* Fixes top-level menu items not being clickable.
* Optimizes images.
* Removes affiliate code functionality.
* Removes all end-of-file closing PHP tags.
* Updates to Bootstrap 2.3.0.
* Updates `standard_comment_form` to be an overridable function.

### Activity Tabs Widget

* Fixes features images not sizing correctly.
* Fixes sticky post issues in popular tab.

### Google Custom Search Widget

* Adds enhancements to improve stability.
* Updates to latest version of the Google Custom Search markup and API.

### Archive Template

* Fixes archive page template performance issues.

### Change Set

**Added**

* css/less/author-box.less
* css/less/comments.less
* css/less/footer.less
* css/less/header.less
* css/less/ie-styles.less
* css/less/misc.less
* css/less/mixins.less
* css/less/navigation.less
* css/less/pages.less
* css/less/posts.less
* css/less/structure.less
* css/less/style.less
* css/less/typography.less
* css/less/variables.less
* css/less/widgets-responsive.less
* css/less/widget.less
* css/lib/less/bootstrap-responsive.less
* css/lib/less/bootstrap.less
* images/social/small/dribbble.png
* images/social/small/github/png
* js/admin.min.js
* js/admin.post.min.js
* js/dev/admin.js
* js/dev/theme.main.js
* js/dev/theme.tiled-gallery.js
* js/lib/bootstrap.min.js
* js/theme.comments.min.js
* js/theme.main.min.js
* js/theme.tiled-gallery.min.js

**Removed**

* css/admin.header.css
* css/admin.social-options.css
* css/editor-style-full.css
* css/less/editor-style-full.less
* css/less/theme.less
* css/theme.videopress.css
* js/admin.header.min.js
* js/admin.menu.min.js
* js/admin.post.min.js
* js/admin.publishing-options.min.js
* js/admin.seo-notifications.min.js
* js/admin.site-mode.min.js
* js/admin.social-options.min.js
* js/admin.template-sitemap.min.js
* js/admin.widgets.min.js
* js/lib/bootstrap/bootstrap.min.js
* js/theme.comments.min.js 
* js/theme.videopress.min.js

**Modified**

* 404.php
* breadcrumbs.php
* codekit-config.json
* css/admin.css
* css/img/glyphicons-halflings.png
* css/img/icn-blog.png
* css/img/icn-heart.png
* css/img/icn-standard.png
* css/img/icn-wrench.png
* css/img/icn-standard-logo.png
* css/less/admin.less
* css/less/admin.social-options.less
* css/less/theme.contrast-light.less
* css/less/theme.videopress.less
* css/less/theme-responsive.less
* css/lib/bootstrap-responsive.css
* css/lib/bootstrap.css
* css/theme.contrast-light.css
* css/theme.css
* css/theme-responsive.css
* functions.php
* header.php
* images/bg-quote-dark.png
* images/bg-quote-rtl.png
* images/bg-quote.png
* images/icn-author-sprites-white.png
* images/icn-author-sprites.png
* images/icn-link-dark.png
* images/icn-link.png
* images/icn-permalink.png
* images/icn-quote-dark-rtl.png
* images/icn-quote-dark.png
* images/icn-quote.png
* images/icn-sitemap.png
* images/icn-standard-small.png
* images/icn-tags.png
* images/lightning.png
* images/social/small/email.png
* images/social/small/facebook.png
* images/social/small/foursquare.png
* images/social/small/google_plus.png
* images/social/small/pinterest.png
* images/social/small/rss.png
* images/social/small/soundcloud.png
* images/social/small/twitter.png
* images/social/small/vimeo.png
* images/social/small/youtube.png
* images/sticky.png
* index.php
* js/admin.media-upload.min.js
* js/dev/admin.header.js
* js/dev/admin.media-upload.js
* js/dev/admin.social-options.js
* js/dev/admin.template-sitemap.js
* js/dev/theme.comments.js
* js/dev/theme.js
* js/dev/theme.main.js
* js/lib/bootstrap/bootstrap.js
* js/theme.min.js
* lang/standard.mo
* lang/standard.po
* lib/activity/css/less/admin.less
* lib/activity/css/less/widget.less
* lib/activity/css/widget.css
* lib/activity/plugin.php
* lib/breadcrumbs/standard_breadcrumbs.php
* lib/google-custom-search/css/less/admin.less
* lib/google-custom-search/css/less/widget.less
* lib/google-custom-search/css/widget.css
* lib/google-custom-search/js/dev/admin.js
* lib/google-custom-search/lib/Standard_Google_Custom_Search.template.php
* lib/google-custom-search/plugin.php
* lib/influence/css/admin.css
* lib/influence/css/fake-personal.jpg
* lib/influence/css/less/admin.less
* lib/influence/css/less/widget.less
* lib/influence/css/widget.css
* lib/influence/plugin.php
* lib/personal-image/css/admin.css
* lib/personal-image/css/less/admin.less
* lib/personal-image/css/less/widget.less
* lib/personal-image/js/admin.min.js
* lib/personal-image/js/dev/admin.js
* lib/personal-image/plugin.php
* lib/personal-image/views/admin.php
* lib/seo/css/admin.css
* lib/seo/css/less/admin.less
* lib/seo/plugin.php
* lib/seotitles/standard_seotitles.php
* lib/Standard_Comment_Policy.template.html
* lib/Standard_Nav_Walker.class.php
* lib/standard-ad-125x125/css/admin.css
* lib/standard-ad-125x125/css/fake-125.jpg
* lib/standard-ad-125x125/css/less/admin.less
* lib/standard-ad-125x125/css/less/widget.less
* lib/standard-ad-125x125/css/widget.css
* lib/standard-ad-125x125/images/standard-125-1.jpg
* lib/standard-ad-125x125/images/standard-125-2.jpg
* lib/standard-ad-125x125/js/admin.min.js
* lib/standard-ad-125x125/js/dev/admin.js
* lib/standard-ad-125x125/plugin.php
* lib/standard-ad-125x125/views/admin.php
* lib/standard-ad-125x125/views/widget.php
* lib/standard-ad-300x250/css/admin.css
* lib/standard-ad-300x250/css/less/admin.less
* lib/standard-ad-300x250/css/less/widget.less
* lib/standard-ad-300x250/fake-300.jpg
* lib/standard-ad-300x250/js/admin.min.js
* lib/standard-ad-300x250/js/dev/admin.js
* lib/standard-ad-300x250/plugin.php
* lib/standard-ad-300x250/standard-300.jpg
* lib/standard-ad-300x250/views/widget.php
* lib/standard-ad-billboard/css/admin.css
* lib/standard-ad-billboard/css/less/admin.less
* lib/standard-ad-billboard/css/less/widget.less
* lib/standard-ad-billboard/fake-468.jpg
* lib/standard-ad-billboard/js/admin.min.js
* lib/standard-ad-billboard/js/dev/admin.js
* lib/standard-ad-billboard/plugin.php
* lib/standard-ad-billboard/standard-468.jpg
* lib/standard-ad-billboard/views/widget.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* loop.php
* rtl.css
* screenshot.png
* search.php 
* single.php
* social-networking.php
* style.css
* template-archives.php

## 3.2 Beta (November 21st, 2012)

### Core Theme

* Adds support for PHPDoc.
* Adds support for CodeKit.
* Adds minified CSS and JavaScripts files.
* Fixes ol and ul margins.
* Fixes nested navigation menu items in IE8.
* Fixes Standard SEO keyword highlighting.
* Fixes Jetpack Photo issues.
* Fixes improperly escaped attributes.
* Changes ```custom_comment``` function in functions.php to ```standard_custom_comment```.
* Improves header markup.
* Removes WP-PageNavi styles and places them in a [plugin](https://github.com/eightbit/plugins).
* Removes default "Home" link from menus.
* Updates Bootstrap to version 2.2.1.
* Updates theme preview screenshot.

### Change Set

**Added**

* codekit-config.json
* css/less/admin.less
* css/less/admin.header.less
* css/less/admin.social-options.less
* css/less/editor-style.less
* css/less/editor-style-full.less
* css/less/theme.contrast-light.less
* css/less/theme.less
* css/less/theme.videopress.less
* css/less/theme-responsive.less
* css/lib/less/bootstrap.less
* css/lib/less/bootstrap-responsive.less
* css/theme-responsive.css
* css/theme.css
* js/admin.header.min.js
* js/admin.media-upload.min.js
* js/admin.menu.min.js
* js/admin.post.min.js
* js/admin.publishing-options.min.js
* js/admin.seo-notification.min.js
* js/admin.site-mode.min.js
* js/admin.social-options.min.js
* js/admin.template-sitemap.min.js
* js/admin.widgets.min.js
* js/dev/admin.header.js
* js/dev/admin.media-upload.js
* js/dev/admin.menu.js
* js/dev/admin.post.js
* js/dev/admin.publishing-options.js
* js/dev/admin.seo-notification.js
* js/dev/admin.site-mode.js
* js/dev/admin.social-options.js
* js/dev/admin.template-sitemap.js
* js/dev/admin.widgets.js
* js/dev/theme.comments.js
* js/dev/theme.js
* js/dev/theme.videopress.js
* js/lib/bootstrap/bootstrap.min.js
* js/theme.comments.min.js
* js/theme.min.js
* js/theme.videopress.min.js
* lib/activity/css/less/admin.less
* lib/activity/css/less/widget.less
* lib/google-custom-search/css/less/admin.less
* lib/google-custom-search/css/less/widget.css
* lib/google-custom-search/js/admin.min.js
* lib/google-custom-search/js/dev/admin.js
* lib/influence/css/less/admin.less
* lib/influence/css/less/widget.less
* lib/personal-image/css/less/admin.less
* lib/personal-image/css/less/widget.less
* lin/personal-image/js/admin.min.js
* lib/personal-image/js/dev/admin.js
* lib/seo/css/less/admin.less
* lib/seo/js/admin.min.js
* lib/seo/js/dev/admin.js
* lib/standard-ad-125x125/css/less/admin.less
* lib/standard-ad-125x125/css/less/widget.less
* lib/standard-ad-125x125/js/admin.min.js
* lib/standard-ad-125x125/js/dev/admin.js
* lib/standard-ad-300x250/css/less/admin.less
* lib/standard-ad-300x250/css/less/widget.less
* lib/standard-ad-300x250/js/admin.min.js
* lib/standard-ad-300x250/js/dev/admin.js
* lib/standard-ad-billboard/css/less/admin.less
* lib/standard-ad-billboard/css/less/widget.less
* lib/standard-ad-billboard/js/admin.min.js
* lib/standard-ad-billboard/js/dev/admin.js

**Removed**

* lib/activity/js/widget.js
* lib/google-custom-search/js/admin.js
* lib/personal-image/js/admin.js
* lib/seo/js/admin.js
* lib/standard-ad-125x125/js/admin.js
* lib/standard-ad-300x250/js/admin.js
* lib/standard-ad-billboard/js/admin.js
* js/admin.header.js
* js/admin.media-upload.js
* js/admin.menu.js
* js/admin.post.js
* js/admin.publishing-options.js
* js/admin.seo-notification.js
* js/admin.site-mode.js
* js/admin.social-options.js
* js/admin.template-sitemap.js
* js/admin.widgets.js
* js/theme.comments.js
* js/theme.js
* js/theme.videopress.js

**Modified**

* 404.php
* breadcrumbs.php
* comments.php
* css/admin.css
* css/admin.header.css
* css/admin.social-options.css
* css/editor-style.css
* css/editor-style-full.css
* css/img/glyphicons-halflings.png
* css/img/glyphicons-halflings-white.png
* css/lib/bootstrap.css
* css/lib/bootstrap-responsive.css
* css/theme.contrast-light.css
* css/theme.videopress.css
* functions.php
* footer.php
* header.php
* image.php
* index.php
* lib/activity/css/admin.css
* lib/activity/css/widget.css
* lib/activity/plugin.php
* lib/activity/views/admin.php
* lib/breadcrumbs/standard_breadcrumbs.php
* lib/google-custom-search/css/admin.css
* lib/google-custom-search/css/widget.css
* lib/google-custom-search/plugin.php
* lib/google-custom-search/views/admin.php
* lib/google-custom-search/views/widget.php
* lib/influence/css/admin.css
* lib/influence/css/widget.css
* lib/influence/plugin.php
* lib/influence/views/admin.php
* lib/influence/views/widget.php
* lib/personal-image/css/admin.css
* lib/personal-image/css/widget.css
* lib/personal-image/plugin.php
* lib/personal-image/views/admin.php
* lib/personal-image/views/widget.php
* lib/seo/css/admin.css
* lib/seo/js/admin.js
* lib/seo/plugin.php
* lib/seotitles/standard_seotitles.php
* lib/Standard_Nav_Walker.class.php
* lib/standard-ad-125x125/css/admin.css
* lib/standard-ad-125x125/css/widget.css
* lib/standard-ad-125x125/plugin.php
* lib/standard-ad-125x125/views/admin.php
* lib/standard-ad-125x125/views/widget.php
* lib/standard-ad-300x250/css/admin.css
* lib/standard-ad-300x250/css/widget.css
* lib/standard-ad-300x250/plugin.php
* lib/standard-ad-300x250/views/admin.php
* lib/standard-ad-300x250/views/widget.php
* lib/standard-ad-billboard/css/admin.css
* lib/standard-ad-billboard/css/widget.css
* lib/standard-ad-billboard/plugin.php
* lib/standard-ad-billboard/views/admin.php
* lib/standard-ad-billboard/views/widget.php
* loop.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* js/admin.header.js
* page.php
* page-offline-mode
* pagination.php
* search.php
* screenshot.png
* sidebar.php
* single.php
* social-networking.php
* style.css
* template-archives.php
* template-fullwidth.php
* template-sitemap.php

## 3.1.3 (February 22nd, 2013)

### Social Influence Widget

* Updates widget to use Twitter's new API.

### Change Set

**Modified**

* lib/influence/plugin.php
* style.css

## 3.1.2 (October 19th, 2012)

### Core Theme

* Fixes missing markup comment in loop.php.
* Updates version number.

### Social Influence Widget

* Removes support for FeedBurner since Google is deprecating the API on October 20th, 2012.
* Updates styles to adjust for FeedBurner being removed.

### Change Set

**Removed**

* lib/influence/js/admin.js

**Modified**

* lib/influence/css/icn-social-sprites.png
* lib/influence/css/widget.css
* lib/influence/plugin.php
* lib/influence/views/admin.php
* lib/influence/views/widget.php
* loop.php
* style.css

## 3.1.1 (October 16th, 2012)

### Core Theme

* Updates version number.

### Social Influence Widget

* Fixes Twitter always returning a ```0``` count due to a Twitter API change.

### Change Set

**Modified**

* lib/influence/plugin.php
* style.css

## 3.1 (October 3rd, 2012)

### Core Theme

* Adds ability to override ```custom_comment``` function in child themes.
* Adds meta description for category / archive pages.
* Adds content / description to link post format.
* Adds dynamic sizing to link post format.
* Adds dynamic sizing to video post format.
* Adds title attribute to navigation menu items.
* Adds SEO warning message for long post titles.
* Adds auto-generation of image alt tags for SEO friendliness.
* Adds Google+ avatar to post Standard SEO search results preview.
* Adds LinkedIn, SoundCloud, and Foursquare social icons.
* Fixes PHP error in ```standard_has_logo``` function.
* Fixes RSS feeds doubling up site title.
* Fixes plugin CSS loading order.
* Fixes [Google Rich Snippets Tool](http://www.google.com/webmasters/tools/richsnippets) issues.
* Fixes responsive video issues in comments.
* Fixes breadcrumbs showing on static home pages.
* Fixes issues with admin offline message and footer site link URLs.
* Fixes footer widgets and footer menu not being visible to logged in users in offline mode.
* Fixes dark contrast author comments.
* Fixes dark contrast Jetpack comments.
* Fixes dark contrast status post format.
* Fixes dark contrast footer widgets.
* Fixes HTTPS issues with social icons.
* Fixes permalink issues with author archives.
* Fixes Bootstrap's span class rule.
* Fixes localization / translation issues for admin site icon description, post SEO instructions, and comment reply fields.
* Fixes WP-PageNavi styles.
* Fixes responsive landscape rotation issues on mobile devices.
* Fixes RTL issues with logo, navigation, lists, blockquotes, footer credit, and status post format.
* Fixes header preview issues with logo not positioning correctly.
* Fixes IE8 navigation and VideoPress issues.
* Updates language files.

### 300x250 Ad Widget

* Fixes 300x250 ads not working with "accessibility mode" enabled.

### 468x60 Ad Widget

* Fixes 468x60 ads not working with "accessibility mode" enabled.

### Activity Tabs Widget

* Fixes localization / translation issues.

### Google Custom Search Widget

* Adds support for latest version of Google Custom Search.
* Adds Google Custom Search to 404 page.

### Change Set

**Added**

* images/social/small/foursquare.png
* images/social/small/linkedin.png
* images/social/small/soundcloud.png
* js/admin.post.js

**Modified**

* 404.php
* css/admin.css
* css/admin.header.css
* css/theme.contrast-light.css
* footer.php
* functions.php
* header.php
* index.php
* image.php
* js/admin.header.js
* js/theme.js
* js/theme.videopress.js
* lang/standard.mo
* lang/standard.po
* lib/activity/views/admin.php
* lib/breadcrumbs/standard_breadcrumbs.php
* lib/google-custom-search/css/admin.css
* lib/google-custom-search/css/widget.css
* lib/google-custom-search/lib/Standard_Google_Custom_Search.template.php
* lib/google-custom-search/views/admin.php
* lib/google-custom-search/view/widget.php
* lib/seo/css/admin.css
* lib/seo/plugin.php
* lib/seotitles/standard_seotitles.php
* lib/Standard_Nav_Walker.class.php
* lib/standard-ad-125x125/plugin.php
* lib/standard-ad-300x250/js/admin.js
* lib/standard-ad-300x250/plugin.php
* lib/standard-ad-billboard/js/admin.js
* loop.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* page.php
* rtl.css
* social-networking.php
* style.css
* template-archives.php
* template-fullwidth.php
* template-sitemap.php

## 3.0.2 (July 19th, 2012)

### Core Theme

* Fixes fonts not scaling when browser zooms.
* Fixes header image positioning when using menu below header.
* Fixes comments in loop-quote.php.

### Social Influence Widget

* Fixes issues with counts not expiring and automatically updating.

### 125x125 Ad Widget

* Fixes issues with media uploader not firing in Mac Firefox.

### Full-Width Template

* Adds comments to template.

### Change Set

**Modified**

* lang/standard.mo
* lang/standard.po
* lib/influence/plugin.php
* lib/standard-ad-125x125/css/admin.css
* loop-quote.php
* style.css
* template-fullwidth.php

## 3.0.1 (July 9th, 2012)

### Core Theme

* Adds compatibility with Platinum SEO.
* Adds support for zooming on mobile devices.
* Adds ability to reset the social icons. Ideal for preview / beta users who now show missing images.
* Adds two "helper functions" to assist header improvements.
* Adds link to header image when no logo is present.
* Adds support for displaying image post format posts in RSS.
* Adds support to navigation walker open menu links in new tabs when set in the menu dashboard.
* Fixes an issue with "Sitemap" page template being disabled.
* Fixes VideoPress related imports for child themes.
* Fixes contrast import for child themes.
* Fixes social icon delete issues in Mac Firefox.
* Fixes an issue with the logo not working in the header.
* Fixes editor-style.css to reflect how unordered lists look on published posts.
* Fixes footer privacy policy link to adhere to permalink settings.
* Fixes footer privacy policy improperly showing a comma.
* Fixes site icon admin issue.
* Fixes theme customizer logo display issue.
* Fixes Twitter social icon to match new branding.
* Improves version detection.
* Improves core theme JavaScript functionality to support child themes that disable responsive functionality.
* Improves logo, header images, header text, and header ad 
combinations.
* Improves SEO of header elements.
* Promotes two "helper functions" to "custom filters" in functions.php.
* Removes unused images.

### Personal Image Widget

* Fixes issues with multiple instances.
* Fixes images not centering if width is less than 300px wide.
* Fixes issues with placeholder not displaying in Firefox.

### Social Influence Widget

* Improves communication between Standard and Twitter, Facebook, and FeedBurner.
* Improves caching and value serialization.
* Improves clearing out old values.

### 125x125 Ad Widget

* Fixes class names to prevent ad-blocking software from hiding advertisements.

### 300x250 Ad Widget

* Fixes directory name to prevent ad-blocking software from hiding advertisements.
* Moves misplaced styles from styles.css to widget.css.

### 468x60 Ad Widget

* Fixes directory name to prevent ad-blocking software from hiding advertisements.
* Fixes issues with placeholder not displaying in Firefox.
* Moves misplaced styles from styles.css to widget.css.

### Change Set

**Modified**

* css/admin.css
* css/editor-style.css
* functions.php
* footer.php
* header.php
* images/social/small/twitter.png
* js/admin.header.js
* js/admin.media-upload.js
* js/admin.social-options.js
* js/admin.template-sitemap.js
* js/theme.js
* lang/standard.mo
* lang/standard.po
* lib/ad-125x125 → lib/standard-ad-125x125
* lib/ad-300x250 → lib/standard-ad-300x250
* lib/ad-468x60 → lib/standard-ad-billboard
* lib/influence/plugin.php
* lib/influence/views/widget.php
* lib/personal-image/css/admin.css
* lib/personal-image/css/widget.css
* lib/personal-image/js/admin.js
* lib/Standard_Nav_Walker.class.php
* style.css

**Removed**

* images/bg-admin.png
* images/default-gravatar.jpg
* images/img-brand.png
* images/img-logo.png

## 3.0 (June 29th, 2012)

### Documentation

* [Initial release](http://docs.8bit.io/)

### Theme

* [Initial Release](http://standardtheme.com)