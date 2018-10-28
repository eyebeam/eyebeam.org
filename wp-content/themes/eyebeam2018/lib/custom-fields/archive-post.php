<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_archive-post',
		'title' => 'Archive post',
		'fields' => array (
			array (
				'key' => 'field_5a9b5a99ed3b3',
				'label' => 'Residents',
				'name' => 'residents',
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
					0 => 'post_title',
				),
				'max' => '',
			),
			array (
				'key' => 'field_5a9b5acfed3b4',
				'label' => 'Year',
				'name' => 'year',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a9b59a4ed3ae',
				'label' => 'Media',
				'name' => 'media',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a9b59f2ed3af',
						'label' => 'Media type',
						'name' => 'media_type',
						'type' => 'radio',
						'column_width' => '',
						'choices' => array (
							'image' => 'Image',
							'video_url' => 'Video URL',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => '',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_5a9b5a35ed3b0',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b59f2ed3af',
									'operator' => '==',
									'value' => 'image',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5a9b5a51ed3b1',
						'label' => 'Video URL',
						'name' => 'video_url',
						'type' => 'text',
						'instructions' => 'currently only YouTube URLs work',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b59f2ed3af',
									'operator' => '==',
									'value' => 'video_url',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a9b5a79ed3b2',
						'label' => 'Caption',
						'name' => 'caption',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'basic',
						'media_upload' => 'no',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Media',
			),
			array (
				'key' => 'field_5aa1b7e8b1f58',
				'label' => 'Show Related Readings Automatically',
				'name' => 'show_related',
				'type' => 'radio',
				'choices' => array (
					'auto' => 'Show Related Readings Automatically',
					'manual' => 'Manually Select Related Readings',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'auto',
				'layout' => 'horizontal',
			),						
			array (
				'key' => 'field_586bce21ov69',
				'label' => 'Related Readings',
				'name' => 'related_readings',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'event,project,resident,post',
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
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5aa1b7e8b1f58',
							'operator' => '==',
							'value' => 'manual',
						),
					),
					'allorany' => 'all',
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'archive',
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
