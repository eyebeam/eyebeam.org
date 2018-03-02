<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page',
		'title' => 'Page',
		'fields' => array (
			array (
				'key' => 'field_5a8dbc2bc2b76',
				'label' => 'Page items',
				'name' => 'items',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a8dbca1c2b78',
						'label' => 'Item type',
						'name' => 'type',
						'type' => 'select',
						'column_width' => '',
						'choices' => array (
							'hero' => 'Hero',
							'module' => 'Module',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5a99c12e21c32',
						'label' => 'Hero type',
						'name' => 'hero_type',
						'type' => 'radio',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'hero',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'choices' => array (
							'image' => 'Image hero',
							'text' => 'Text hero',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
					),
					array (
						'key' => 'field_5a99b7e5f5658',
						'label' => 'Hero image (desktop)',
						'name' => 'hero_image_desktop',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'hero',
								),
								array (
									'field' => 'field_5a99c12e21c32',
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
						'key' => 'field_5a99b82ef5659',
						'label' => 'Hero image (mobile)',
						'name' => 'hero_image_mobile',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'hero',
								),
								array (
									'field' => 'field_5a99c12e21c32',
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
						'key' => 'field_5a99c1e221c35',
						'label' => 'Hero text',
						'name' => 'hero_text',
						'type' => 'wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'hero',
								),
								array (
									'field' => 'field_5a99c12e21c32',
									'operator' => '==',
									'value' => 'text',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'no',
					),
					array (
						'key' => 'field_5a99c21321c37',
						'label' => 'Module type',
						'name' => 'module_type',
						'type' => 'radio',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'choices' => array (
							'full_width' => 'Full width',
							'two_thirds' => '2/3 width',
							'one_half' => '1/2 width',
							'one_third' => '1/3 width',
							'collection' => 'Collection',
							'toc' => 'Table of contents',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
					),
					array (
						'key' => 'field_5a8dbc52c2b77',
						'label' => 'Module page',
						'name' => 'module_page',
						'type' => 'post_object',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'collection',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'toc',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'post_type' => array (
							0 => 'post',
							1 => 'page',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'allow_null' => 1,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5a8dbdb674ec3',
						'label' => 'Module title',
						'name' => 'module_title',
						'type' => 'text',
						'instructions' => 'overrides page title',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'toc',
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
						'key' => 'field_5a8dbe674005e',
						'label' => 'Module URL',
						'name' => 'module_url',
						'type' => 'text',
						'instructions' => 'overrides page URL',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'collection',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'toc',
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
						'key' => 'field_5a8dbe814005f',
						'label' => 'Module description',
						'name' => 'module_description',
						'type' => 'wysiwyg',
						'instructions' => 'overrides page excerpt',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'toc',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'no',
					),
					array (
						'key' => 'field_5a8dbeeb40060',
						'label' => 'Module image',
						'name' => 'module_image',
						'type' => 'image',
						'instructions' => 'overrides page image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'two_thirds',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'collection',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'toc',
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
						'key' => 'field_5a99b92df565d',
						'label' => 'Module video URL',
						'name' => 'module_video_url',
						'type' => 'text',
						'instructions' => 'only YouTube is supported currently',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'two_thirds',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'one_third',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'collection',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '!=',
									'value' => 'toc',
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
						'key' => 'field_5a99b8bdf565b',
						'label' => 'Module TOC',
						'name' => '',
						'type' => 'message',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '==',
									'value' => 'module',
								),
								array (
									'field' => 'field_5a99c21321c37',
									'operator' => '==',
									'value' => 'toc',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'message' => 'List all the modules on the page.',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Item',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
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
