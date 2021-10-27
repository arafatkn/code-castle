<?php

/**
 * Plugin Name: Code Castle
 * Plugin URI: http://wordpress.org/plugins/code-castle/
 * Description: A wide collection of small tools for making wp developer and administrators life easier.
 * Version: 0.0.4
 * Author: Arafat Islam
 * Author URI: https://arafatkn.com
 * Text Domain: code-castle
 */

namespace Arafatkn;


// Exit if accessed directly.
if( !defined( 'ABSPATH' ) )
    exit;

require __DIR__ . '/vendor/autoload.php';


class WpDens
{
    /**
     * Plugin Version
     *
     * @var string
     */
    public $version = '0.0.1';

    /**
     * The single instance of the class.
     */
    protected static $_instance = null;


    public function __construct()
    {
        $this->define_constants();

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

        $this->loadPages();

        $this->appsero_init_tracker_code_castle();
    }


    /**
     * Initializes the WpDens() class
     *
     * Checks for an existing WpDens() instance
     * and if it doesn't find one, creates it.
     */
    public static function instance()
    {

        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        define( 'WPDENS_VERSION', $this->version );
        define( 'WPDENS_ROOT_PATH', plugin_dir_path( __FILE__ ) );
        define( 'WPDENS_ROOT_URL', plugins_url( '/', __FILE__ ) );
    }


    /**
     * Enqueue CSS and JS
     */
    public function enqueue_scripts()
    {
        wp_enqueue_style( 'wp-dens', WPDENS_ROOT_URL . 'css/styles.css' );
    }


    /**
     * Load WP Dens pages
     */
    public function loadPages()
    {
        // Add settings page for set API key
        new \Arafatkn\WpDens\Pages\Index();
    }


    /**
     * Initialize the plugin tracker
     *
     * @return void
     */
    private function appsero_init_tracker_code_castle() {

        if ( ! class_exists( '\Appsero\Client' ) ) {
            require_once __DIR__ . '/appsero/src/Client.php';
        }

        $client = new \Appsero\Client( 'c70fce4c-9bb8-4eea-92bb-38bda7c1bb1a', 'Code Castle', __FILE__ );

        // Active insights
        $client->insights()->init();

        // Active automatic updater
        $client->updater();

    }

}


WpDens::instance();