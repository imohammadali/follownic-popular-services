<?php

/*
 * Plugin Name: Follownic Popular Services
 * Plugin URI: https://bwawwp.com/my-plugin/
 * Description: Follownic popular services in each social 
 * Author: Mohammadali Ebrahimzadeh
 * Version: 1.0.1
 * Author URI: https://iammohammadali.ir
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: fn-popular-services
 * Domain Path: /languages
 */

/**
 * FNPS => [f]ollow[N]ic [P]opular [S]ervices
 */

//prevent directory to access this file
defined('ABSPATH') || exit;

//Define version
define('FNPS_VER', '1.0.1');

//Define absolute path
define('FNPS_PATH', plugin_dir_path(__FILE__));

define('FNPS_CORE_PATH', FNPS_PATH . 'core/');


//Define url path
define('FNPS_Assets', plugin_dir_url(__FILE__) . 'assets/');
define('FNPS_CSS_PATH', FNPS_Assets . 'css/');
define('FNPS_IMAGES_PATH', FNPS_Assets . 'images/');
define('FNPS_JS_PATH', FNPS_Assets . 'js/');
/**
 * Include class file
 */
require(FNPS_CORE_PATH . 'FNPS_Core.php');
/**
 * Instantiate Plugin Core
 */
$FNPSCore = new FNPS_Core(FNPS_VER);
/**
 * Run Plugin Core
 */
$FNPSCore->run();
