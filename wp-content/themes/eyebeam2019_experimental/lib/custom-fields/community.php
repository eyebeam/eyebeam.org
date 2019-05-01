<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_community-general',
		'title' => 'Community General',
		'fields' => array (
			array (
				'key' => 'field_5696c421d47b8',
				'label' => 'Program Name',
				'name' => 'program_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5696c44e75bdf',
				'label' => 'Info',
				'name' => 'info',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5696c46404295',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_56dce78017abf',
				'label' => 'Related Name',
				'name' => 'related_name',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'resident',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '34',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
