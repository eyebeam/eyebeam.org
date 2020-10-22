<?php

$type = get_sub_field('module_type');

$section_header = get_sub_field('section_header');
$section_header_link = get_sub_field('section_header_link');
$type = "section_header";

eyebeam2018_module(array(
	'type' => $type,
	'section_header' => $section_header,
	'section_header_link' => $section_header_link,
));
