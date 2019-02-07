<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_residency',
		'title' => 'Residency',
		'fields' => array (
			array (
				'key' => 'field_5a9ada68d08a3',
				'label' => 'Partners',
				'name' => 'partners',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a9ada88d08a4',
						'label' => 'Logo',
						'name' => 'logo',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5a9adaa1d08a5',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Partner',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '245',
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
		'menu_order' => 10,
	));
}
