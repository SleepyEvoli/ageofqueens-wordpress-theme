<?php
declare(strict_types=1);

function ageofqueenstheme_scripts() {
	wp_enqueue_script('bootstrap',get_stylesheet_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js');
	wp_enqueue_style( 'mainStyle', get_stylesheet_directory_uri() . '/build/style-index.css');
}

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

// Custom Block Classes

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