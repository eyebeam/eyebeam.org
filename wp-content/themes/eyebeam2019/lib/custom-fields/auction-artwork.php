<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_auction-artwork',
		'title' => 'Auction Artwork',
		'fields' => array (
			array (
				'key' => 'field_5cebcceb23744',
				'label' => 'Artist Bio',
				'name' => 'artist_bio',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_5cebd077386a7',
				'label' => 'Minimum bid',
				'name' => 'minimum_bid',
				'type' => 'number',
				'default_value' => 1000,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'auction',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
}
