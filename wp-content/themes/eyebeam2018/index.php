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

*/

get_header();
the_post();

get_template_part("templates/post");

get_footer();
