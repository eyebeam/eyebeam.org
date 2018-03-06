<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_post-meta',
		'title' => 'Post meta',
		'fields' => array (
			array (
				'key' => 'field_5a9f0855a5b19',
				'label' => 'Post meta',
				'name' => 'post_meta',
				'type' => 'wysiwyg',
				'instructions' => 'content for the top-right corner',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '34',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '35',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 2,
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
