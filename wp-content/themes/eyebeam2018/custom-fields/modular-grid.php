<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_modular-grid',
		'title' => 'Modular Grid',
		'fields' => array (
			array (
				'key' => 'field_5a8dbc2bc2b76',
				'label' => 'Modular Grid Items',
				'name' => 'items',
				'type' => 'repeater',
				'required' => 0,
				'sub_fields' => array (
					array (
						'key' => 'field_5a8dbc52c2b77',
						'label' => 'Page',
						'name' => 'page',
						'type' => 'post_object',
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
						'key' => 'field_5a8dbca1c2b78',
						'label' => 'Width',
						'name' => 'width',
						'type' => 'select',
						'column_width' => '',
						'choices' => array (
							'one-third' => 'One third',
							'two-thirds' => 'Two thirds',
							'full-width' => 'Full width',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5a8dbdb674ec3',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => 'overrides page title',
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
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'instructions' => 'overrides page URL',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a8dbe814005f',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'textarea',
						'instructions' => 'overrides page excerpt',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'html',
					),
					array (
						'key' => 'field_5a8dbeeb40060',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => 'overrides page featured image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a8dbca1c2b78',
									'operator' => '!=',
									'value' => 'two-thirds',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
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
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-modular-grid.php',
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
