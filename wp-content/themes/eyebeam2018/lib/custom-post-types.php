<?php

$labels = array(
	'name' => 'Residents',
	'singular_name' => 'Resident',
	'add_new' => 'Add New Resident',
	'add_new_item' => 'Add New Resident',
	'edit_item' => 'Edit Resident',
	'new_item' => 'New Resident',
	'all_items' => 'All Residents',
	'view_item' => 'View Resident',
	'search_items' => 'Search Residents',
	'not_found' =>  'No Residents Found',
	'not_found_in_trash' => 'No Residents found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Residents',
);
register_post_type('resident', array(
	'labels' => $labels,
	'has_archive' => true,
	'public' => true,
	'query_var' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
	'taxonomies' => array('post_tag', 'category'),
	'exclude_from_search' => false,
	'capability_type' => 'post',
	'rewrite' => array( 'slug' => 'residents' ),
));

$labels = array(
	'name' => 'Events',
	'singular_name' => 'Event',
	'add_new' => 'Add New Event',
	'add_new_item' => 'Add New Event',
	'edit_item' => 'Edit Event',
	'new_item' => 'New Event',
	'all_items' => 'All Events',
	'view_item' => 'View Event',
	'search_items' => 'Search Events',
	'not_found' =>  'No Events Found',
	'not_found_in_trash' => 'No Events found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Events',
);
register_post_type('event', array(
	'labels' => $labels,
	'has_archive' => true,
	'public' => true,
	'query_var' => true,
	'supports' => array('title', 'thumbnail', 'page-attributes'),
	'taxonomies' => array('post_tag', 'category'),
	'exclude_from_search' => false,
	'capability_type' => 'post',
	'rewrite' => array('slug' => 'events'),
));

$labels = array(
	'name' => 'Archive',
	'singular_name' => 'Item',
	'add_new' => 'Add Item',
	'add_new_item' => 'Add Item',
	'edit_item' => 'Edit Item',
	'new_item' => 'New Item',
	'all_items' => 'All Items',
	'view_item' => 'View Item',
	'search_items' => 'Search Items',
	'not_found' =>  'No Items Found',
	'not_found_in_trash' => 'No Items found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Archive',
);
register_post_type('archive', array(
	'labels' => $labels,
	'has_archive' => false,
	'public' => true,
	'query_var' => false,
	'supports' => array('title', 'editor', 'page-attributes'),
	'taxonomies' => array(),
	'exclude_from_search' => true,
	'capability_type' => 'post',
	'rewrite' => array('slug' => 'archive'),
));

$labels = array(
	'name' => 'Recent Press',
	'singular_name' => 'Recent Press',
	'add_new' => 'Add New Recent Press',
	'add_new_item' => 'Add Recent Press',
	'edit_item' => 'Edit Recent Press',
	'new_item' => 'New Recent Press',
	'all_items' => 'All Recent Press',
	'view_item' => 'View Recent Press',
	'search_items' => 'Search Recent Press',
	'not_found' =>  'No Recent Press Found',
	'not_found_in_trash' => 'No Recent Press found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Recent Press',
);
register_post_type('recentpress', array(
	'labels' => $labels,
	'has_archive' => true,
	'public' => true,
	'query_var' => true,
	'supports' => array('title', 'thumbnail', 'page-attributes'),
	'taxonomies' => array('post_tag', 'category'),
	'exclude_from_search' => false,
	'capability_type' => 'post',
	'rewrite' => array('slug' => 'recentpress'),
));

$labels = array(
	'name' => 'Media Release',
	'singular_name' => 'Media Release',
	'add_new' => 'Add New Media Release',
	'add_new_item' => 'Add Media Release',
	'edit_item' => 'Edit Media Release',
	'new_item' => 'New Media Release',
	'all_items' => 'All Media Release',
	'view_item' => 'View Media Release',
	'search_items' => 'Search Media Release',
	'not_found' =>  'No Media Release Found',
	'not_found_in_trash' => 'No Media Release found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Media Release',
);
register_post_type('mediarelease', array(
	'labels' => $labels,
	'has_archive' => true,
	'public' => true,
	'query_var' => true,
	'supports' => array('title', 'thumbnail','page-attributes' ),
	'taxonomies' => array( 'post_tag', 'category' ),
	'exclude_from_search' => false,
	'capability_type' => 'post',
	'rewrite' => array( 'slug' => 'mediarelease' ),
));

$labels = array(
	'name' => 'Staff',
	'singular_name' => 'Staff',
	'add_new' => 'Add New Staff',
	'add_new_item' => 'Add Staff',
	'edit_item' => 'Edit Staff',
	'new_item' => 'New Staff',
	'all_items' => 'All Staff',
	'view_item' => 'View Staff',
	'search_items' => 'Search Staff',
	'not_found' =>  'No Staff Found',
	'not_found_in_trash' => 'No Staff found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Staff',
);
register_post_type( 'staff', array(
	'labels' => $labels,
	'has_archive' => false,
	'public' => true,
	'query_var' => false,
	'supports' => array('title', 'thumbnail','page-attributes' ),
	'taxonomies' => array( 'post_tag', 'category' ),
	'exclude_from_search' => false,
	'capability_type' => 'post',
	'rewrite' => array( 'slug' => 'staff' ),
));

$labels = array(
	'name' => 'Board',
	'singular_name' => 'Board Member',
	'add_new' => 'Add New Member',
	'add_new_item' => 'Add Board Member',
	'edit_item' => 'Edit Board Member',
	'new_item' => 'New Board Member',
	'all_items' => 'All Board Members',
	'view_item' => 'View Board Member',
	'search_items' => 'Search Board Members',
	'not_found' =>  'No Board Member Found',
	'not_found_in_trash' => 'No Board Members found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Board',
);
register_post_type( 'board', array(
	'labels' => $labels,
	'has_archive' => false,
	'public' => true,
	'query_var' => false,
	'supports' => array('title', 'page-attributes'),
	'taxonomies' => array(),
	'exclude_from_search' => true,
	'capability_type' => 'post',
	'rewrite' => array('slug' => 'board'),
));

$labels = array(
	'name' => 'Advisory Committee',
	'singular_name' => 'Advisory Member',
	'add_new' => 'Add Advisory Member',
	'add_new_item' => 'Add Advisory Member',
	'edit_item' => 'Edit Advisory Member',
	'new_item' => 'New Advisory Member',
	'all_items' => 'All Advisory Members',
	'view_item' => 'View Advisory Member',
	'search_items' => 'Search Advisory Members',
	'not_found' =>  'No Advisory Member Found',
	'not_found_in_trash' => 'No Advisory Members found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Advisory',
);
register_post_type( 'advisory_board', array(
	'labels' => $labels,
	'has_archive' => false,
	'public' => true,
	'query_var' => false,
	'supports' => array('title', 'editor', 'page-attributes'),
	'taxonomies' => array(),
	'exclude_from_search' => true,
	'capability_type' => 'post',
	'rewrite' => array('slug' => 'advisory'),
));

$labels = array(
	'name' => 'Intern',
	'singular_name' => 'Intern',
	'add_new' => 'Add Intern',
	'add_new_item' => 'Add Intern',
	'edit_item' => 'Edit Intern',
	'new_item' => 'New Intern',
	'all_items' => 'All Interns',
	'view_item' => 'View Intern',
	'search_items' => 'Search Interns',
	'not_found' =>  'No Intern Found',
	'not_found_in_trash' => 'No Interns found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Interns',
);
register_post_type('intern', array(
	'labels' => $labels,
	'has_archive' => false,
	'public' => true,
	'query_var' => false,
	'supports' => array('title', 'page-attributes'),
	'taxonomies' => array(),
	'exclude_from_search' => true,
	'capability_type' => 'post',
	'rewrite' => array('slug' => 'intern'),
));
