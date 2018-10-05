<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_post',
		'title' => 'Post',
		'fields' => array (
			array (
				'key' => 'field_56f6810056542',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5aa1b7e8b1f22',
				'label' => 'Show date',
				'name' => 'show_date',
				'type' => 'radio',
				'choices' => array (
					'show' => 'Show publish date',
					'hide' => 'Hide date',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'hide',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5aa1b70edd6c6',
				'label' => 'Meta',
				'name' => 'meta',
				'type' => 'wysiwyg',
				'instructions' => 'override meta box content',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5aa1b7e8b1f22',
							'operator' => '==',
							'value' => 'hide',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_56f5cf3804841',
				'label' => 'Author',
				'name' => 'author',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5aa1b7e8b1f99',
				'label' => 'Show Related Readings',
				'name' => 'show_related_readings',
				'type' => 'radio',
				'choices' => array (
					'show' => 'Show Related Readings',
					'hide' => 'Hide Related Readings',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'show',
				'layout' => 'horizontal',
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
