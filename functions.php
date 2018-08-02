<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

$websiteURL = get_site_url();

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

require_once( 'inc/trainings-cpt.php' );
require_once('wp-advanced-search/wpas.php');


/* -- WP Advanced Search: Search Form -- */
function auto_populate_training_type() {
    $categories = get_terms('document-type');
    foreach($categories as $key => $value) {
        //echo $value;
    }
}
add_action('init', 'auto_populate_training_type');

function auto_populate_training_categories() {
    $categories = get_terms('training-category');
    foreach($categories as $key => $value) {
        //echo $value;
    }
}
add_action('init', 'auto_populate_training_categories');

function admin_default_page() {
    return '/welcome';
}

add_filter('login_redirect', 'admin_default_page');

function include_component($name){
    include( get_template_directory() . '/inc/components/'.$name.'.php');
}


function hrDocuSearch() {
    $args = array();
    $args['form'] = array('action' => ' '.$websiteURL.' /search-results/', 'disable_wrappers' => true);

    $args['wp_query'] = array( 'post_type' => array('trainings' => 'Trainings'), 'posts_per_page' => 27, 'order' => 'DESC', 'orderby' => 'title');
    $args['fields'][] = array( 'type' => 'search', 'placeholder' => 'Training Title or Keyword(s)', 'compare' => 'LIKE', 'pre_html' => '<div class="row"><div class="col-xs-12">', 'post_html' => '</div></div><div class="clearfix gap-mini"></div>');
    $args['fields'][] = array( 'type' => 'taxonomy', 'taxonomy' => 'training-type', 'values' => auto_populate_training_type(), 'default' => '', 'compare' => 'EXISTS', 'format' => 'select', 'allow_null' => '- Any type -', 'pre_html' => '<div class="row"><div class="col-xs-12 col-sm-4">', 'post_html' => '</div><div class="clearfix gap hidden-sm hidden-md hidden-lg"></div>');
    $args['fields'][] = array( 'type' => 'taxonomy', 'taxonomy' => 'training-category', 'values' => auto_populate_training_categories(), 'default' => '', 'compare' => 'EXISTS', 'format' => 'select', 'allow_null' => '- Any Category -', 'pre_html' => '<div class="col-xs-12 col-sm-4">', 'post_html' => '</div><div class="clearfix gap hidden-sm hidden-md hidden-lg"></div>');

    $args['fields'][] = array( 'type' => 'submit', 'value' => 'Search', 'pre_html' => '<div class="col-xs-12 col-sm-4">', 'post_html' => '</div></div><div class="clearfix gap-mini"></div>');
    register_wpas_form('hrDocuSearch', $args);
}
add_action('init', 'hrDocuSearch');

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function getMembershipLevel(){
    if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
    {
        global $current_user;
        $current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
        return $current_user->membership_level;
    }
}


/*
	Add the PMPro meta box to a CPT
*//*
function my_page_meta_wrapper()
{
    //duplicate this row for each CPT
    add_meta_box('pmpro_page_meta', 'Require Membership', 'pmpro_page_meta', 'trainings', 'side');
}
function pmpro_cpt_init()
{
    if (is_admin())
    {
        add_action('admin_menu', 'my_page_meta_wrapper');
    }
}
add_action("init", "pmpro_cpt_init", 20);
*/
/*
function wcr_category_fields($term) {
    // we check the name of the action because we need to have different output
    // if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
    if (current_filter() == 'category_edit_form_fields') {
        $user_level = get_term_meta($term->term_id, 'user_level', true);

        ?>
        <tr class="form-field">
            <th valign="top" scope="row"><label for="term_fields[user_level]"><?php _e('User level'); ?></label></th>
            <td>
                <select name="term_fields[user_level]">
                    <option value="manager" <?= $user_level == 'manager' ? 'selected' : '';?>>Manager</option>
                    <option value="trainer" <?= $user_level == 'trainer' ? 'selected' : '';?>>>Trainer</option>
                    <option value="international" <?= $user_level == 'international' ? 'selected' : '';?>>>International</option>
                </select>
            </td>
        </tr>
    <?php } elseif (current_filter() == 'category_add_form_fields') {
        ?>
        <div class="form-field">
            <label for="term_fields[user_level]"><?php _e('User level'); ?></label>

            <select name="term_fields[user_level]">
                <option value="manager">Manager</option>
                <option value="trainer">Trainer</option>
                <option value="international">International</option>
            </select>

        </div>
        <?php
    }
}*/

// Add the fields, using our callback function
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
//add_action('category_add_form_fields', 'wcr_category_fields', 10, 2);
//add_action('category_edit_form_fields', 'wcr_category_fields', 10, 2);

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('bootstrap_toolkit', get_template_directory_uri() . '/js/lib/bootstrap-toolkit.min.js', array('jquery'), '1.0.0'); //
        wp_enqueue_script('bootstrap_toolkit'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }

    wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
    wp_enqueue_style( 'font_awesome_css', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));


    register_sidebar(array(
        'name' => __('Footer 1', 'html5blank'),
        'description' => __('Footer 1', 'html5blank'),
        'id' => 'footer1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer 2', 'html5blank'),
        'description' => __('Footer 2', 'html5blank'),
        'id' => 'footer2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer 3', 'html5blank'),
        'description' => __('Footer 3', 'html5blank'),
        'id' => 'footer3',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer 4', 'html5blank'),
        'description' => __('Footer 4', 'html5blank'),
        'id' => 'footer4',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page();
}

function be_arrows_in_menus( $item_output, $item, $depth, $args ) {
    if( in_array( 'menu-item-has-children', $item->classes ) ) {
        $arrow = 0 == $depth ? '<i class="fa fa-angle-down"></i>' : '';
        $item_output = str_replace( '</a>', $arrow . '</a>', $item_output );
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'be_arrows_in_menus', 10, 4 );

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*
add_filter('acf/validate_value/name=trainer_notes___handout_pdf', 'acf_unique_value_field', 10, 4);
add_filter('acf/validate_value/name=positive_action__cards_pdf', 'acf_unique_value_field', 10, 4);
add_filter('acf/validate_value/name=trainer_notes___handout_word', 'acf_unique_value_field', 10, 4);
*/

function write_log(...$data){
    ob_start();
        var_dump($data);
    $output = ob_get_clean();
    file_put_contents('_log.txt', $output);
}

/* DOWNLOAD UTILS */

function on_download($download, $version = null){
    //ob_start();

    global $wpdb;

    $download_id = $download->get_id();

    $row = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE meta_value = $download_id", ARRAY_A );
    $post_id = isset($row['post_id']) ? $row['post_id'] : false;
    if(!$post_id) return;

    $group_access_id = get_post_meta( $post_id, '_user_level_group', true );

   // write_log(check_download_limit($group_access_id));

    if(!user_has_access_to_post($group_access_id) || check_download_limit($group_access_id)){
        return;
    }

    $download_id = $download->get_id();

    //$results = $wpdb->get_results( "select post_id, meta_key from $wpdb->postmeta where meta_value = $download_id", ARRAY_A );
    $row = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE meta_value = $download_id", ARRAY_A );

    $post_id = isset($row['post_id']) ? $row['post_id'] : false;

    $meta_data = get_user_download_stat();

    $meta_item = array(
        $group_access_id => array($post_id)
    );

    $meta_value = false;


    if( !$meta_data || @count($meta_data) == 0){
        $meta_value = $meta_item;
    } else{

        if(!array_key_exists($group_access_id, $meta_data)){
            $meta_data[$group_access_id] = array($post_id);
        } else{
            if(!in_array($post_id, $meta_data[$group_access_id]))
                $meta_data[$group_access_id][] = $post_id;
        }

        $meta_value = $meta_data;
    }

    if($meta_value){
        set_user_download_stat($meta_value);
    }

}

add_action( 'dlm_downloading', 'on_download');

function can_download_filter($can_download, $download){

    global $wpdb;
    $can_download = false;

    //write_log($download);
    //return $can_download;

    $download_id = $download->get_id();

    $row = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE meta_value = $download_id", ARRAY_A );
    $post_id = isset($row['post_id']) ? $row['post_id'] : false;

    if(!$post_id) {
        return $can_download;
    }

    $group_access_id = get_post_meta( $post_id, '_user_level_group', true );

    $pro_required = get_post_meta( $download_id, 'pro_level_required', true );
    $check_pro = isset($pro_required[0]);

    $can_download = can_download($group_access_id, $check_pro);

    return $can_download;
}

add_filter( 'dlm_can_download', 'can_download_filter', 10, 2);

//dlm_can_download

//echo "Stat: <br>\n";
//print_r(get_user_download_stat());

function get_level_download_limits(){

    $arr = array();

    if( have_rows('userlevelsrepeater', 'option') ):

        // loop through the rows of data
        while ( have_rows('userlevelsrepeater') ) : the_row();

            // display a sub field value
            //the_sub_field('sub_field_name');

            if($u_level = get_sub_field('pmp_c_user_level_id') && $u_limit = get_sub_field('pmp_c_user_level_limit')){
                $arr[][$u_level] = $u_limit;
            }

        echo get_sub_field('pmp_c_user_level_id').' | '.get_sub_field('pmp_c_user_level_limit').'<br>';
        endwhile;

    else :

        // no rows found

    endif;

    return $arr;
}

//print_r(get_level_download_limits());
//delete_user_meta(wp_get_current_user()->ID,'__download_stat');

$level_download_limits = array(
    //'level_id' => 'limit'

    4 => 1,
    5 => 6,
    6 => 12,
    7 => -1, // pro
    8 => -1, // pro+

    10 => 1,
    11 => 6,
    13 => 12,
    16 => -1, // pro
    17 => -1, // pro+

    12 => 1,
    18 => 6,
    19 => 12,
    21 => -1, // pro
    22 => -1 // pro+

);

function set_user_download_stat($_data){
    $user_id = wp_get_current_user()->ID;
    $_data = serialize($_data);
    update_user_meta( $user_id, '__download_stat', $_data );
}

function user_curr_post_selected($group_id){
    $curr_post = get_the_ID();
    $user_stat = get_user_download_stat();

    return isset($user_stat[$group_id]) ? array_key_exists($curr_post ,$user_stat[$group_id] ) : false;
}

function get_user_download_stat(){
    $user_id = wp_get_current_user()->ID;
    $meta = get_user_meta( $user_id, '__download_stat', true );
    return unserialize($meta);
}

function get_user_selected_modules_count($group_id){
    $stat = get_user_download_stat();
    $stat_items = isset($stat[$group_id]) ? $stat[$group_id] : null;

    return !empty($stat_items) ? count($stat_items) : 0;
}

function get_curr_user_level_limit($level_id){
    global $level_download_limits;

    return isset($level_download_limits[$level_id]) ? $level_download_limits[$level_id] : 0;
}
//delete_user_meta(wp_get_current_user()->ID, '_download_stat');
//var_dump(get_user_download_stat());
//print_r(get_curr_user_level_limit());


function get_current_user_level(){

    $user = wp_get_current_user();
    if(!$user) return;

    $user_level = pmpro_getMembershipLevelsForUser($user->ID);
    return $user_level;
}

//print_r(get_current_user_level());
//var_dump(get_user_download_stat());

function get_user_level_id($post_group_id){
    $group_levels = get_levels_by_group_id($post_group_id);
    $user_levels = get_current_user_level();
    $lid = false;

    if(!empty($group_levels) && !empty($user_levels)){
        foreach($group_levels as $gl){
            foreach($user_levels as $ul){
                if($gl->level == $ul->id){
                    $lid = $ul->id;
                    break;
                }
            }
        }
    }

    return $lid;
}

//var_dump(get_user_level_id(1));

function get_levels_by_group_id($group_id){
    //echo $group_id;
    global $wpdb;
    //$group_id = intval( $group_id );

    $results = $wpdb->get_results("select * from  $wpdb->pmpro_membership_levels_groups WHERE `group`='" . esc_sql( $group_id ) . "'");
    return $results;
}

function get_group_by_level_id($level_id){
    global $wpdb;
    $level_id = intval( $level_id );
    $row = $wpdb->get_row("select * from  $wpdb->pmpro_membership_levels_groups WHERE level='" . esc_sql( $level_id ) . "' LIMIT 1");
    return $row;
}

function get_groups_by_levels_ids($levels_ids = array()){
    if(!is_array($levels_ids)) return false;

    global $wpdb;
    // @todo aff filter
    $levels_ids = implode(',', $levels_ids);
    //return $levels_ids;
    //$level_id = intval( $level_id );
    //echo "select * from  $wpdb->pmpro_membership_levels_groups WHERE level IN('" . esc_sql( $levels_ids ) . "')";
    $rows = $wpdb->get_results("select `group` from $wpdb->pmpro_membership_levels_groups WHERE level IN(" . esc_sql( $levels_ids ) . ")");

    if($rows)
        $rows = array_map(function($item){
            return $item->group;
        },$rows);

    return $rows;
}

function get_user_groups(){
    $user_levels = get_current_user_level();
    if(!$user_levels) return null;

    $user_groups = array();
    $levels_ids = array();

    //return $user_levels;

    foreach($user_levels as $level){
        $levels_ids[] = $level->id;
    }

    $groups = get_groups_by_levels_ids($levels_ids);

    return $groups;
}

function user_has_access_to_post($g_id){
    $user_groups = get_user_groups();

    //echo $g_id.' | '.implode(',', $user_groups);
   // var_dump(in_array($g_id, $user_groups));
    return in_array($g_id, $user_groups);
}

function _getAllLevels(){
    global $wpdb;
    //$levels = $wpdb->get_results("select * from information_schema.tables");
    $levels = $wpdb->get_results("select * from  $wpdb->pmpro_membership_levels_groups");
    //return $levels;
    $tmp_arr = array();

    if(!empty($levels)){
       foreach ($levels as $level){
           $tmp_arr[$level->group][] = $level->level;
       }
    }

    return $tmp_arr;
}

function _getAllGroups(){
    global $wpdb;
    $groups = $wpdb->get_results("select * from  $wpdb->pmpro_groups");
    return $groups;
}

/*
function get_all_groups_levels($group_id){
    if(!$group_id) return false;

    global $wpdb;

    //return $levels_ids;
    //$level_id = intval( $level_id );
    //echo "select * from  $wpdb->pmpro_membership_levels_groups WHERE level IN('" . esc_sql( $levels_ids ) . "')";

    $rows = $wpdb->get_results("select * from $wpdb->pmpro_membership_levels_groups WHERE group ='" . esc_sql( $group_id ) . "' LIMIT 1");
    return $rows;
}
*/
//print_r(get_all_groups_levels(3));


function check_download_limit($group_id){

    $lid = get_user_level_id($group_id);
    $limit = get_curr_user_level_limit($lid);

    $selected_modules = get_user_selected_modules_count($group_id);

    //var_dump($limit);
    //var_dump($selected_modules);

    if($limit == -1) return false;

    return $limit <= $selected_modules;
}

//check_download_limit(1);

function can_download($group_access_id, $check_pro = false){
    if($check_pro) {
        if (!isLevelPro($group_access_id)) return false;
    }

    return !check_download_limit($group_access_id) && !user_curr_post_selected($group_access_id) && user_has_access_to_post($group_access_id);
}

function isLevelPro($post_group_id){
    global $level_download_limits;

    $pro_arr = array_keys(array_filter($level_download_limits, function($value){ return $value == -1;}));
    $user_level_id = get_user_level_id($post_group_id);

    return in_array($user_level_id, $pro_arr);
}

//var_dump(isLevelPro(1));

//we have to put everything in a function called on init, so we are sure Register Helper is loaded
function my_pmprorh_init()
{
    //don't break if Register Helper is not loaded
    if(!function_exists( 'pmprorh_add_registration_field' )) {
        return false;
    }

    //define the fields
    $fields[] = new PMProRH_Field(
        'additional license',						// input name, will also be used as meta key
        'select',						// type of field
        array(
            'options' => array(				// <option> elements for select field
                ''		=> '',			// blank option - cannot be selected if this field is required
                'user_1'	=> '1 user - 10$',	// <option value="lessthan2000">&lt; $2,000</option>
                'user_2'	=> '2 users - 20$',	// <option value="2000to5000">$2,000-$5,000</option>
                'user_3'	=> '3 users - 30$',	// <option value="5000to10000">$5,000-$10,000</option>
            )
        )
    );

    //add the fields into a new checkout_boxes are of the checkout page
    foreach($fields as $field)
        pmprorh_add_registration_field(
            'checkout_boxes',				// location on checkout page
            $field						// PMProRH_Field object
        );
    //that's it. see the PMPro Register Helper readme for more information and examples.
}
add_action( 'init', 'my_pmprorh_init' );
function my_pmpro_checkout_level($level)
{
    if ( ! empty( $_REQUEST['user_1'] ) ) {
        // $level->initial_payment = $level->initial_payment + 175; //to update the initial payment.
        $level->billing_amount = $level->billing_amount + 10;	//to update recurring payments too
    }
    if ( ! empty( $_REQUEST['user_2'] ) ) {
        $level->billing_amount = $level->billing_amount + 20;	//to update recurring payments too
    }
    if ( ! empty( $_REQUEST['user_3'] ) ) {
        $level->billing_amount = $level->billing_amount + 30;	//to update recurring payments too
    }

    return $level;
}

//print_r(get_user_meta (  get_user_meta( $user->ID, 'additional license', true )));



/******* USER GROUP TRAINING ACCESS *********/

function training_user_group_access_level_add_meta_box() {
    $screens = array( 'trainings' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'user_level_group',
            'Membership Group Access ',
            'show_custom_meta_box',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'training_user_group_access_level_add_meta_box' );
function show_custom_meta_box( $post ) {
    wp_nonce_field( 'user_level_group', 'user_level_group_nonce' );
    $value = get_post_meta( $post->ID, '_user_level_group', true );
    echo '<label for="website">';
    //_e( 'Description for this field', 'myplugin_textdomain' );
    echo '</label> ';

    //print_r(_getAllGroups());

    $groups = _getAllGroups();

    if($groups){
        ?>
        <select id="user_level_group" name="user_level_group">
            <? foreach($groups as $group): ?>
                <option value="<?php echo $group->id?>" <?echo esc_attr($value) == $group->id ? 'selected' : ''?>><?php echo $group->name;?></option>
            <?endforeach;?>
        </select>
        <?
    }

    //echo 'v:'.esc_attr( $value );

    //echo '<input type="text" id="user_level_group" name="user_level_group" value="' . esc_attr( $value ) . '" size="25" />';
}
function myplugin_save_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['user_level_group_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['user_level_group_nonce'], 'user_level_group' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'trainings' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['user_level_group'] ) ) {
        return;
    }
    $my_data = sanitize_text_field( $_POST['user_level_group'] );
    update_post_meta( $post_id, '_user_level_group', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );