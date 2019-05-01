<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_interns',
		'title' => 'Interns',
		'fields' => array (
			array (
				'key' => 'field_5a9a2dda683a3',
				'label' => 'Intern title',
				'name' => 'intern_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'intern',
					'order_no' => 0,
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
