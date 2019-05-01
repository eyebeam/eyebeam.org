<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_education',
		'title' => 'Education',
		'fields' => array (
			array (
				'key' => 'field_5aa1c0ea4cb9d',
				'label' => 'Sponsors intro',
				'name' => 'sponsors_intro',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_5aa1c0cc4cb9b',
				'label' => 'Sponsors',
				'name' => 'sponsors',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5aa1c0de4cb9c',
						'label' => 'Logo',
						'name' => 'logo',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Sponsor',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '699',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 10,
	));
}
