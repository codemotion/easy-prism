<?php
/**
 * Prism Syntax Highlither
 *
 * @package   easy-prism-syntax-highlighter
 * @author    Dmitriy Belyaev <admin@codemotion.ru>
 * @license   GPL-2.0+
 * @link      http://codemotion.ru
 * @copyright 12-17-2014 codemotion
 */

/**
 * Prism Syntax Highlither class.
 *
 * @package PrismSyntaxHighlither
 * @author  Dmitriy Belyaev <admin@codemotion.ru>
 */
class PrismSyntaxHighlither{
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = "1.0.1";

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = "easy-prism-syntax-highlighter";

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		// add_action("init", array($this, "load_plugin_textdomain"));

		// Add the options page and menu item.
		// add_action("admin_menu", array($this, "add_plugin_admin_menu"));

		// Load admin style sheet and JavaScript.
		// add_action("admin_enqueue_scripts", array($this, "enqueue_admin_styles"));
		// add_action("admin_enqueue_scripts", array($this, "enqueue_admin_scripts"));
		// Load public-facing style sheet and JavaScript.
		add_action("wp_enqueue_scripts", array($this, "enqueue_styles"));
		add_action("wp_enqueue_scripts", array($this, "enqueue_scripts"));
		add_action ("wp_enqueue_scripts",array($this,"load"));
		// Move auto p filter 
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 12);
		// add shortcodes
		add_shortcode('code',array($this,'shortcode'));
		add_shortcode('c',array($this,'shortcode'));
		// Load TinyMce button plugin
		add_filter('mce_external_plugins',array($this,'tinymce_plugin'));
		add_filter('mce_buttons',array($this,'tinymce_button'));
	}
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn"t been set, set it now.
		if (null == self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	* Shorcode implementaion
 	*
	* @since     1.0.0
	*
	* @param    array    $attrs    Shortcode attributes
	* @param    string   $content  Content
	*/
	public function shortcode($attrs, $content = ""){
		$class = '';
		if(isset($attrs[0])){
	    	$class = "language-".$attrs[0];
	    }
	    else {
	    	$class = "language-markup";
	    }
		if(FALSE !== strpos($content,"\n")){
			$content = trim($content,"\n\r");
			return "<pre class=\"{$class}\"><code class=\"{$class}\">{$content}</code></pre>";
		}
		else {
			return "<code class=\"{$class}\">{$content}</code>";	
		}
	}	


	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_register_style("prism", plugins_url("css/prism.css", __FILE__), array(),
			$this->version);
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_register_script("prism", plugins_url("js/prism.js", __FILE__), array("jquery"),
			$this->version);
	}

	public function load(){
		global $post;
		// if(!is_singular()) return;
		$content = $post->post_content;
		if ( FALSE !== strpos( $content, '[code' ) OR FALSE !== strpos( $content, '<code class="lang' ) ) {
			wp_enqueue_style('prism');
			wp_enqueue_script('prism');
		}
	}

	/**
	 * Tinymce plugin
	 *
	 * @since    1.0.0
	 */
	public function tinymce_plugin($plugins_array){
		 $plugin_array['code'] = plugins_url($this->plugin_slug) . '/js/tinymce.js';
		 return $plugin_array;
	}
	/**
	 * Tinymce button
	 *
	 * @since    1.0.0
	 */
	public function tinymce_button($buttons) {
   		array_push($buttons, 'separator', 'wp-prism-hl-code');
   		return $buttons;
   	}
}