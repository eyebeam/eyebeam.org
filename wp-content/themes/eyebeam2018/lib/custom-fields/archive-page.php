<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_archive-page',
		'title' => 'Archive page',
		'fields' => array (
			array (
				'key' => 'field_5a9b5875fa439',
				'label' => 'Intro',
				'name' => 'intro',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 2,
				'formatting' => 'html',
			),
			array (
				'key' => 'field_5a9b5bb27264e',
				'label' => 'Featured items',
				'name' => 'featured_items',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a9b5bd27264f',
						'label' => 'Archive item',
						'name' => 'archive_item',
						'type' => 'relationship',
						'column_width' => '',
						'return_format' => 'object',
						'post_type' => array (
							0 => 'archive',
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
						'max' => 1,
					),
					array (
						'key' => 'field_5a9b619493d0d',
						'label' => 'Override content',
						'name' => 'override',
						'type' => 'radio',
						'column_width' => '',
						'choices' => array (
							'hide' => 'Use Archive Item content',
							'show' => 'Override content',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 'hide',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_5a9b5c0572650',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => 'overrides archive title',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b619493d0d',
									'operator' => '==',
									'value' => 'show',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a9b5c2472651',
						'label' => 'Name',
						'name' => 'name',
						'type' => 'text',
						'instructions' => 'overrides resident name',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b619493d0d',
									'operator' => '==',
									'value' => 'show',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a9bc0d1c3b19',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'wysiwyg',
						'instructions' => 'overrides archive item',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b619493d0d',
									'operator' => '==',
									'value' => 'show',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'basic',
						'media_upload' => 'no',
					),
					array (
						'key' => 'field_5a9b5c3f72652',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => 'overrides archive item',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b619493d0d',
									'operator' => '==',
									'value' => 'show',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5a9b5c8772653',
						'label' => 'Caption',
						'name' => 'caption',
						'type' => 'textarea',
						'instructions' => 'overrides archive item',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b619493d0d',
									'operator' => '==',
									'value' => 'show',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 2,
						'formatting' => 'html',
					),
					array (
						'key' => 'field_5a9bc0f1c3b1a',
						'label' => 'Video URL',
						'name' => 'video_url',
						'type' => 'text',
						'instructions' => 'overrides archive item',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a9b619493d0d',
									'operator' => '==',
									'value' => 'show',
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
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Featured Item',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '5203',
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
		'menu_order' => 0,
	));
}
