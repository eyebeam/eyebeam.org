<?php
/*

Oh hai, this is the eyebeam2018 theme. By default, this is the template that
gets chosen. This is all written from scratch, with <3
(20180220/dphiffer)

Some basic ground rules:
- I don't conform to WordPress style guide, because it looks gross to my eyes.
- I use tabs for indenting, and spaces to align things. It's fussy, I know.
- Underscores for naming_things instead of camelCase.
- Try to keep everything self-contained within the theme code base as much as
  possible.
- We put things in $GLOBALS['eyebeam2018'] to make things easier.
- Develop with WP_DEBUG enabled in wp-config.php, otherwise turn it off.
- Default to the simplest dumbest thing.
(20180303/dphiffer)

Some places you might want to look next:
* templates/post.php
* header.php and footer.php
* functions.php
* style.css (no preprocessing magic, just straight up CSS)
* js/eyebeam2018.js
* lib/*

For a general discussion on how WordPress themes work, you might want to check
out these articles:
https://codex.wordpress.org/Theme_Development
https://developer.wordpress.org/themes/getting-started/

(20180307/dphiffer)

*/

get_header();
the_post();

get_template_part("templates/post");

get_footer();
