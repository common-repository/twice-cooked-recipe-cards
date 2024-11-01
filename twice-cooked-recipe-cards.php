<?php
/*
Plugin Name: Twice cooked Recipe Cards
Plugin URI: https://basilosaur.us/wordpress/plugins/tcrc/
Description: TCRC helps you turn your recipes into fancy electronic recipe cards. It provides you with all the tools you need to include microformatting that helps search engines recognize ingredients, instructions, and whole recipes. And it provides a mechanism for pop-out, printable pages so that readers can easily add your recipe to their physical collection.
Version: 1.2
Author: Adam D. Zolkover
Author URI: https://basilosaur.us/
License: GPL2
*/
/*
Copyright 2014  Adam D. Zolkover  (email : info@basilosaur.us)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* IMPLEMENT THE FOLLOWING -- from http://microformats.org/wiki/hRecipe

* hrecipe

* fn. required. text. the name of the recipe.

* ingredient. required. 1 or more. text with optional valid (x)HTML markup.

* yield. optional. text.

* instructions. optional. text with optional valid (x)HTML markup.

* duration. optional. 1 or more. text. 

*/

defined('ABSPATH') or die("No script kiddies please!");


if(!class_exists('tc_rc')) {
/* This is the main class of the plugin. All the content stuff goes here.  Mostly. */
	class tc_rc {
		
		var $options = '';
		
		/* This is the constructor method for the class */
    	public function __construct() {
			$this->options = get_option('tcrc_settings');    		
    		
    		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_stuff') ); //enqueue scripts, etc.
    		add_action( 'wp_head', array( $this, 'add_css' ) ); // add custom CSS to the site head
    		add_action('init', array($this, 'tinymce_buttons')); //add tinyMCE buttons
    		add_action ('admin_menu', array($this, 'settings_page_init')); //add settings page to the admin side
    		add_action ('admin_menu', array($this, 'settings_init')); //add settings to the settings page
    		
    		$this->add_the_shortcodes();

    	}
    	
		public static function activate() {
		
		}
		  
		public static function deactivate() {
		
		}
		//ADD SHORTCODES
		private function add_the_shortcodes() {
    		add_shortcode('recipe', array($this, 'hrecipe'));
    		add_shortcode('recipename', array($this, 'fn'));
    		add_shortcode('ingredient', array($this, 'ingredient'));
    		add_shortcode('duration', array($this, 'hduration'));
    		add_shortcode('yield', array($this, 'hyield'));
    		add_shortcode('instructions', array($this, 'hinstructions'));
    		add_shortcode('summary', array($this, 'hsummary'));
    		add_shortcode('nutrition', array($this, 'hnutrition'));
		}
		//ADD CUSTOM STYLES
		public function add_css() {
			if (!empty( $this->options['inside_posts'] ) ) {
				echo "\n <!-- TCRC Custom Style -->\n<style type=\"text/css\">\n";
				echo $this->options['inside_posts'];
				echo "\n</style>\n";		
			}
		}
		//ENQUEUE SCRIPTS
		public function enqueue_stuff() {
			wp_enqueue_style( 'tcrc_onthepage', plugins_url( 'css/onthepage.css' , __FILE__ ) );
			if (!wp_script_is( 'jquery', 'enqueued' )) {
				wp_enqueue_script('jquery');
			}    
			wp_enqueue_script('tcrc', plugins_url( '/js/tcrc.js' , __FILE__ ), array( 'jquery' ) );
			wp_localize_script('tcrc', 'tcrc_vars', array( 'printercss' => plugins_url( '/css/printer.css' , __FILE__ ),
																		  'customprintercss' => $this->options['print_card'] ) );		
		}
		//TINYMCE BUTTONS
		public function tinymce_buttons() {
			add_filter( 'mce_external_plugins', array($this, 'tinymce_add_buttons') );
			add_filter( 'mce_buttons', array($this, 'tinymce_register_buttons') );
		}
		public function tinymce_add_buttons( $plugin_array ) { //TELLS TINYMCE WHERE THE PLUGIN IS
			$plugin_array['tcrc'] = plugins_url( '/js/tinyMCE.js' , __FILE__ );
			return $plugin_array;
		}
		public function tinymce_register_buttons( $buttons ) { //ADDS BUTTONS TO TINYMCE ARRAY
			array_push( $buttons, '|', 'hrecipe', 'tcrc');
			return $buttons;
		}
		
		/****************************************************
		 These are the shortcodes that build the recipe card
		*****************************************************/
		
		public function hrecipe($atts, $content = null) {
			$atts = shortcode_atts( array('class' => ''), $atts );
			if (is_null($content)) {
				return;
			} else {
				return '<div id="tcrc-recipe" class="tcrc-recipe hrecipe ' . $atts['class'] . '">
						  <div class="tcrc-topicons">
						  <a id="tcrc-recipebutton" href="#"><img src="' . plugins_url( 'images/print.png' , __FILE__ ) . '" title="Print Recipe"></a>
						  </div>'
						  . do_shortcode($content) .
						  '</div>';	
			}	
		}
		public function fn($atts, $content = null) {
			if (is_null($content)) {
				return;
			} else {
				return '<h1 class="tcrc-fn fn">' . $content . '</h1>';
			}		
		}
		public function ingredient($atts, $content = null) {
			if (is_null($content)) {
				return;
			} else {
				return '<span class="tcrc-ingredient ingredient">' . $content . '</span>';		
			}
		}
		public function hduration($atts, $content = null) {	
			if (is_null($content)) {
				return;
			} else {
				return '<span class="tcrc-duration duration">' . $content . '</span>';		
			}
		}
		public function hyield($atts, $content = null) {	
			if (is_null($content)) {
				return;
			} else {
				return '<span class="tcrc-yield yield">' . $content . '</span>';		
			}
		}
		public function hinstructions($atts, $content = null) {
			if (is_null($content)) {
				return;
			} else {
				return '<div class="tcrc-instructions instructions">' . $content . '</div>';		
			}
		}
		public function hsummary($atts, $content = null) {
			if (is_null($content)) {
				return;
			} else {
				return '<p class="tcrc-summary summary">' . $content . '</p>';		
			}
		}
		public function hnutrition($atts, $content = null) {	
			if (is_null($content)) {
				return;
			} else {
				return '<span class="tcrc-nutrition nutrition">' . $content . '</span>';		
			}
		}

		/****************************************************
		 Sets up the admin side of the plugin
		*****************************************************/
		
		//Initiates settings page
		public function settings_page_init() {
			add_options_page(
				'Twice Cooked Recipe Cards Settings',
				'Recipe Cards',
				'activate_plugins',
				'tcrc-settings',
				array($this, 'tcrc_options_page') );
		}
		//Initiates settings sections and fields; registers theme settings
		public function settings_init() {	
			add_settings_section(
				'tcrc_custom_css',
				'Add Custom CSS',
				array($this, 'css_settings_section'),
				'tcrc-settings' );
			add_settings_field(
				'tcrc_post_css',
				'Inside Posts',
				array($this, 'css_inside_posts'),
				'tcrc-settings',
				'tcrc_custom_css');
			add_settings_field(
				'tcrc_print_css',
				'On the Printable Card',
				array($this, 'css_print_card'),
				'tcrc-settings',
				'tcrc_custom_css');
			register_setting( 'tcrc-settings', 'tcrc_settings' );
		}
		//callback for the admin settings page
		public function tcrc_options_page() {
		?>
			<div class="wrap" style="text-align: justify; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; word-wrap: break-word;">
					<div id="left" style="float:left; width: 70%;">
					<div class="icon32" id="icon-options-general"><br></div>
					<h2>Twice Cooked Recipe Cards</h2>
					<p>This page allows you to further define the look of your blog's recipe cards as they appear both inside your posts, and in the printer-friendly pop-out window.  Any CSS you enter into the following two boxes will override the default styles for the Twice Cooked Recipe Cards plugin.  But if you choose to do this, remember: keep it simple. Especially with the pop-out cards, the more complex your styling, the more difficult they will be to print.</p>
					<p>The key styles to use in both boxes are as follows:</p>
					<ul style="padding-left:18px;">
						<li><strong>.tcrc-recipe</strong>&nbsp;&nbsp;-&nbsp;&nbsp;Defines the look of the recipe box as a whole. Set borders, background colors, font-styling, etc.</li>
						<li><strong>.tcrc-fn</strong>&nbsp;&nbsp;-&nbsp;&nbsp;Defines the look of the recipe name.</li>
						<li><strong>.tcrc-duration</strong>&nbsp;&nbsp;-&nbsp;&nbsp;Duration field.</li>
						<li><strong>.tcrc-yield</strong>&nbsp;&nbsp;-&nbsp;&nbsp;The yield field.</li>
						<li><strong>.tcrc-ingredient</strong>&nbsp;&nbsp;-&nbsp;&nbsp;The ingredient fields.</li>
					</ul> 
					<form action="options.php" method="post">
					<?php settings_fields('tcrc-settings'); ?>
					<?php do_settings_sections('tcrc-settings'); ?>
					<p class="submit">
						<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
					</form>
				</div>
				<div id="right" style="float:right; width: 22%; margin-left: 2%; margin-top: 12px; padding: 10px 2%; border: 1px solid #aaa;">
				<p><strong>Twice Cooked Recipe Cards</strong> by <a href="https://basilosaur.us">basilosaur.us</a> helps you turn your blog's recipes into fancy electronic recipe cards.  This plugin provides you with all the tools you need to create <a href="http://microformats.org/wiki/hrecipe">microformatting</a> that helps search engines recognize ingredients, instructions, and whole recipes.  And it provides a mechanism to create pop-out, printable pages so that readers can easily add your recipe to their physical collection in the kitchen.</p>
				<p>You can learn more about <strong>Twice Cooked Recipe Cards</strong> at the <a href="https://basilosaur.us/wordpress/plugins/tcrc/">here at the plugin's website</a>.  If you like it, and you find it useful, <strong>please consider donating</strong>.</p>
				</div>
			</div>
		<?php
		}
		//callback for the CSS settings section on the settings page for the plugin
		public function css_settings_section() {
			return;
		}
		//custom CSS textareas
		function css_inside_posts() {
			if (!empty( $this->options['inside_posts'] ) ) {
				$s = $this->options['inside_posts'];		
			} else {
				$s = '';
			}
			echo '<textarea cols="50" rows="12" name="tcrc_settings[inside_posts]">'. $s . '</textarea>';
		}
		function css_print_card() {
			if (!empty( $this->options['print_card'] ) ) {
				$s = $this->options['print_card'];		
			} else {
				$s = '';
			}
			echo '<textarea cols="50" rows="12" name="tcrc_settings[print_card]">'. $s . '</textarea>';
		}

	}
}

if(class_exists('tc_rc')) {
    /* Adds activation and deactivation hooks, so that WordPress can do something with the plugin */
    register_activation_hook(__FILE__, array('tc_rc', 'activate'));
    register_deactivation_hook(__FILE__, array('tc_rc', 'deactivate'));

    // instantiate the plugin class
    $tc_rc = new tc_rc();
}


?>
