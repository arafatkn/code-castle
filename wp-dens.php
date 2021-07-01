<?php

/**
 * Plugin Name: WP Dens
 * Plugin URI: http://wordpress.org/plugins/wp-dens/
 * Description: Appsero
 * Version: 1.0
 * Author: Arafat Islam
 * Text Domain: wp-dens
 */

namespace Arafatkn;


// Exit if accessed directly.
if( !defined( 'ABSPATH' ) )
    exit;

include 'vendor/autoload.php';


class WpDens
{
    /**
     * Plugin Version
     *
     * @var string
     */
    public $version = '0.1';

    /**
     * The single instance of the class.
     */
    protected static $_instance = null;


    public function __construct()
    {
        $this->define_constants();

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

        $this->loadPages();
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
}


WpDens::instance();