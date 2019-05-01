<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_board',
		'title' => 'Board',
		'fields' => array (
			array (
				'key' => 'field_5a9a2d83690e7',
				'label' => 'Board title',
				'name' => 'board_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a9a2d93690e8',
				'label' => 'Board bio',
				'name' => 'board_bio',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'board',
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
