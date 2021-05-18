<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_media-release',
		'title' => 'Media Release',
		'fields' => array (
			array (
				'key' => 'field_5a8dbc52c2b7709999',
				'label' => 'Media Release Page',
				'name' => 'media_release_page',
				'type' => 'relationship',
				'column_width' => '',
				'return_format' => 'url',
				'post_type' => array (
					1 => 'page',
				),
				'max' => 1,
			),
			array (
				'key' => 'field_56b565d272d11',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_56b565e172d13',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'mm/dd/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_56b565ea72d14',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5a8dbe81400699',
				'label' => 'Summary',
				'name' => 'summary',
				'type' => 'wysiwyg',
				'instructions' => 'Add a summary of this media release',
				'column_width' => '',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'mediarelease',
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
