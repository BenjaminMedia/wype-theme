<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */

// Images
add_image_size('cover', 300, 9999, true); // Cover image


add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus(array(
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation_1' => __('Footer Menu 1', 'sage'),
        'footer_navigation_2' => __('Footer Menu 2', 'sage'),
        'footer_navigation_3' => __('Footer Menu 3', 'sage'),
    ));

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => ''
    ];
    $config_dark = [
        'before_widget' => '<section class="widget widget--dark %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => ''
    ];
    register_sidebar([
        'name'          => __('Footer - Column 1', 'sage'),
        'id'            => 'footer-1'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer - Column 2', 'sage'),
        'id'            => 'footer-2'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer - Column 3', 'sage'),
        'id'            => 'footer-3'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer - Column 4', 'sage'),
        'id'            => 'footer-4'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer - Bottom', 'sage'),
        'id'            => 'footer-bottom'
    ] + $config_dark);
    
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});


if( function_exists('acf_add_options_page') ) {
    
  acf_add_options_page(array(
      'page_title'    => 'Wype setup',
      'menu_title'    => 'Wype setup',
      'menu_slug'     => 'theme-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false
  ));
  
  acf_add_options_sub_page(array(
      'page_title'    => 'Theme Header Settings',
      'menu_title'    => 'Header',
      'parent_slug'   => 'theme-general-settings',
  ));
}



/**
 * Register 'Brands' post type
 */
function magazines_post_type() {

   // Labels
  $labels = array(
    'name' => _x("Magazines", "post type general name"),
    'singular_name' => _x("Magazine", "post type singular name"),
    'menu_name' => 'Magazines',
    'add_new' => _x("Add magazine", "team item"),
    'add_new_item' => __("Add new magazine"),
    'edit_item' => __("Edit magazine"),
    'new_item' => __("New magazine"),
    'view_item' => __("View magazine"),
    'search_items' => __("Search magazines"),
    'not_found' =>  __("No magazines found"),
    'not_found_in_trash' => __("Not found"),
    'parent_item_colon' => ''
  );
  
  // Register post type
  register_post_type('magazines' , array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => false,
    'menu_icon' => get_stylesheet_directory_uri() . '/assets/images/icon.png',
    // 'rewrite' => false,
    'rewrite' => array('slug' => 'magazines','with_front' => false),
    'supports' => array('title', 'editor', 'thumbnail'),
    'taxonomies' => array('category')
  ) );
}
add_action( 'init', __NAMESPACE__ . '\\magazines_post_type', 0 );


// add OG meta tags
function fb_opengraph() {
  global $post;
  if(is_single() || is_page()) {
    $size = 'full'; 
    if(has_post_thumbnail($post->ID)) {
      $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), $size);
    } else {      
      $some_img   = get_field( 'some_fallback_image', 'options' );
      $img_src    = wp_get_attachment_image_src( $some_img, $size );
    }

    $cover = get_field( 'cover_url' );
    if($excerpt = $post->post_excerpt) {
      $excerpt = strip_tags($post->post_excerpt);
      $excerpt = str_replace("", "'", $excerpt);
    } else {
      $excerpt = get_bloginfo('description');
    }
    $appId = get_field( 'facebook_app_id', 'options' );
    $appstore_id = get_field( 'appstore_id', 'options' );
  ?>
    <?php if ($appstore_id): ?>
    <meta name="apple-itunes-app" content="app-id=<?php echo $appstore_id; ?>">
    <?php endif ?>
   
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <?php if ($cover): ?>
    <meta property="og:image" content="<?php echo $cover; ?>" />  
    <?php else: ?>
    <meta property="og:image" content="<?php echo $img_src[0]; ?>" />
    <?php endif ?>
    <?php if($appId): ?>
    <meta property="fb:app_id" content="<?php echo $appId; ?>" />
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?php echo $excerpt; ?>" />
    <meta name="twitter:title" content="<?php echo the_title(); ?>" />
    <?php if ($cover): ?>
    <meta property="twitter:image" content="<?php echo $cover; ?>" />  
    <?php else: ?>
    <meta property="twitter:image" content="<?php echo $img_src[0]; ?>" />
    <?php endif; ?>

    <?php
  } else {
    return;
  }
}
add_action('wp_head', __NAMESPACE__ . '\\fb_opengraph', 5);


// cookiescript
// DO NOT show cookiebanner on App pages (onboarding / navigation)
function cookiescript() {
  global $post;
  $cookie_language = get_field( 'cookie_language', 'options' );
  if ( $cookie_language && !is_page_template( array( 'views/template-onboarding.blade.php', 'views/template-navigation.blade.php') ) ) {  ?>
    
    <script id="CookieConsent" src="https://policy.cookieinformation.com/uc.js" data-cbid="c49034f0-983b-46b8-a385-4237baf4fd20" data-culture="<?php echo $cookie_language; ?>" type="text/javascript" async></script>

    <?php
  } else {
    return;
  }
}
add_action('wp_head', __NAMESPACE__ . '\\cookiescript', 5);

