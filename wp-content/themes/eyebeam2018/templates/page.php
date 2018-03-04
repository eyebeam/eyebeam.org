<?php

get_template_part('templates/page-subnav');

eyebeam2018_render_heroes();
eyebeam2018_render_modules();

if (is_front_page()) {
	get_template_part('templates/home-values');
}
