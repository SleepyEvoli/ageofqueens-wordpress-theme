<?php
declare(strict_types=1);

// Loading additional scripts and styles

function ageofqueenstheme_scripts() {
	wp_enqueue_script('bootstrap',get_stylesheet_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js');
	wp_enqueue_style( 'mainStyle', get_stylesheet_directory_uri() . '/build/style-index.css');
}

// Adding Features to the theme

function ageofqueenstheme_features(){
	add_theme_support('editor-styles');
	add_editor_style(array(get_stylesheet_directory_uri() . '/build/style-index.css'));
}

add_action('wp_enqueue_scripts', 'ageofqueenstheme_scripts');
add_action('after_setup_theme', 'ageofqueenstheme_features');

// Custom Post Types

add_action('init', function(){
	register_post_type('members', array(
		'label' => 'Members',
		'description' => 'Members of the Age of Queens community who want to be shown on the website.',
		'public' => true,
		'exclude_from_search' => true,
		'show_in_menu' => true,
		'show_in_rest' => false,
		'menu_icon' => 'dashicons-universal-access',
		'has_archive' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	));
});

add_action('init', function(){
    register_post_type('events', array(
        'label' => 'Events',
        'description' => 'Events of the Age of Queens community.',
        'public' => true,
        'exclude_from_search' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-calendar',
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail')
    ));
});

// show_in_menu = false because we access it through a submenu in events
add_action('init', function(){
    register_post_type('event-games', array(
        'label' => 'Event Games',
        'description' => 'Games played in an events of the Age of Queens community.',
        'public' => true,
        'exclude_from_search' => true,
        'show_in_menu' => false,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-games',
        'has_archive' => true,
        'supports' => array()
    ));
});

// Adding submenu to event Post Type to access event-games from there
add_action('admin_menu', function(){
    add_submenu_page(
        'edit.php?post_type=events',
        'Event Games',
        'Event Games',
        'manage_options',
        'edit.php?post_type=event-games',
        false
    );
});

add_filter('default_title', function(){
    global $post_type;
    if ('event-games' == $post_type) {
        return htmlspecialchars("<Event Name> - <League>: <Team1> vs <Team2>");
    }
});

add_action('init', function(){
	register_post_type('mods', array(
		'label' => 'Mods',
		'description' => 'Mods from the Age of Queens community.',
		'public' => true,
		'exclude_from_search' => true,
		'show_in_menu' => true,
		'show_in_rest' => false,
		'menu_icon' => 'dashicons-buddicons-topics',
		'has_archive' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	));
});

// Custom Placeholder Block
// Basically we are just rendering php instead of using any js features

class CustomPlaceholderBlock {
	function __construct($name){
		$this->name = $name;
		add_action('init', [$this, 'onInit']);
	}

	function ourRenderCallback($attributes, $content){
		ob_start();
		require get_theme_file_path("/custom-blocks/placeholders/{$this->name}.php");
		return ob_get_clean();
	}

	function onInit(){
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/custom-blocks/placeholders/{$this->name}.js", array('wp-blocks', 'wp-editor'));
		register_block_type("ageofqueenstheme/{$this->name}", array('editor_script' => $this->name, 'render_callback' => [$this, 'ourRenderCallback']));
	}
}

new CustomPlaceholderBlock("header");
new CustomPlaceholderBlock("footer");
new CustomPlaceholderBlock("members");
new CustomPlaceholderBlock("twitch");
new CustomPlaceholderBlock("mods");
new CustomPlaceholderBlock("twitch-player");

// Custom Block
// Access to Node Modules and need to be compiled to one file

class CustomBlock {
	function __construct($name, $dynamic = null) {
		$this->name = $name;
		$this->dynamic = $dynamic;
		add_action('init', [$this, 'onInit']);
	}

	function ourRenderCallback($attributes, $content){
		ob_start();
		require get_theme_file_path("/custom-blocks/{$this->name}.php");
		return ob_get_clean();
	}

	function onInit() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));
		if($this->dynamic) register_block_type("ageofqueenstheme/{$this->name}", array('editor_script' => $this->name, 'render_callback' => [$this, 'ourRenderCallback']));
		else register_block_type("ageofqueenstheme/{$this->name}", array('editor_script' => $this->name));

	}
}

new CustomBlock('banner', true);
new CustomBlock('slideshow', true);
new CustomBlock('slide', true);
new CustomBlock('card', true);
new CustomBlock("event-games", true);