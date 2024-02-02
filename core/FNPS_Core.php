<?php

class FNPS_Core
{
	/**
	 * Plugin Version
	 * @var string
	 */
	private $version;
	/**
	 * Page that metaBox must show
	 * @var array
	 */
	private array $metaBoxPages;
	private $prefix = '_FNPS_settings_';
	private $FNPS_domain = 'fn-popular-services';
	private $FNPS_nonce = 'fn-popular-services-nonce';

	private $slick_version = '1.8.0';
	private $bootstrap_version = '5.1.3';
	private $popper_version = '2.9.2';

	public function __construct($version = '1.0.0')
	{
		$this->version      = $version;
		$this->metaBoxPages = array('post', 'page', 'single_services');
		add_action('acf/include_field_types', array($this, 'FNPS_acf_include_field'));
	}

	/**
	 * add acf fields
	 * @return void
	 */
	function FNPS_acf_include_field()
	{
		include_once('acs-fields/class-fnps-acf-field.php');
	}

	/**
	 * Run plugin Core
	 * @return void
	 */
	public function run()
	{
		/**
		 * Start plugin translation
		 */
		$this->translate();

		/**
		 * Save metabox
		 */
		add_action('save_post', array($this, 'saveMetaBox'));
		add_action('edit_post', array($this, 'saveMetaBox'));
		add_action('save_term', array($this, 'saveMetaBox'));
		add_action('edit_term', array($this, 'saveMetaBox'));

		/**
		 * Load admin/public scripts
		 */

		$this->addScripts();
	}

	/**
	 * Translate FN Services Tabs
	 * @return void
	 */
	public function translate()
	{
		add_action('plugin_loaded', function () {
			load_plugin_textdomain($this->FNPS_domain, false, basename(FNPS_PATH) . '/languages/');
		});
	}

	/**
	 * Add Admin/Public scripts and styles
	 * @return void
	 */
	public function addScripts()
	{
		/**
		 * load public script
		 */
		add_action('wp_enqueue_scripts', function () {
			if (is_singular() || is_tax()) {
				wp_enqueue_script('FNPS-public-js', FNPS_JS_PATH . 'public.js', array('jquery'), $this->version, true);
				wp_enqueue_style('FNPS-public-style', FNPS_CSS_PATH . 'public.css', array(), $this->version);
			}
		});
		/**
		 * load admin script
		 */
		add_action('admin_enqueue_scripts', function ($hook) {
			wp_enqueue_media();
			wp_register_style('bootstrap-style', FNPS_CSS_PATH . 'bootstrap.min.css', array(), $this->bootstrap_version);
			wp_register_script('bootstrap-script', FNPS_JS_PATH . 'bootstrap.min.js', array(), $this->bootstrap_version);
			wp_register_script('popper-script', FNPS_JS_PATH . 'popper.min.js', array(), $this->popper_version);
			wp_enqueue_script(
				'fn-popular-services-script',
				FNPS_JS_PATH . 'admin.js',
				array(
					'jquery',
					'jquery-ui-core',
					'jquery-ui-sortable',
					'bootstrap-script',
					'popper-script',
				),
				$this->version,
				true
			);
			wp_enqueue_style(
				'fn-popular-services-style',
				FNPS_CSS_PATH . 'admin.css',
				array('bootstrap-style'),
				$this->version
			);
			if (isset($_REQUEST['tag_ID'])) {
				[
					$this->prefix . 'fnps_service_1'  => $fnps_service_1,
					$this->prefix . 'fnps_service_2'  => $fnps_service_2,
					$this->prefix . 'fnps_service_3'  => $fnps_service_3,
					$this->prefix . 'fnps_service_4'  => $fnps_service_4,
					$this->prefix . 'fnps_service_5'  => $fnps_service_5,
					$this->prefix . 'fnps_service_6'  => $fnps_service_6,

				] = get_term_meta($_REQUEST['tag_ID'], $this->prefix . 'fn_popular_services', true);
			} else {
				[
					$this->prefix . 'fnps_service_1'  => $fnps_service_1,
					$this->prefix . 'fnps_service_2'  => $fnps_service_2,
					$this->prefix . 'fnps_service_3'  => $fnps_service_3,
					$this->prefix . 'fnps_service_4'  => $fnps_service_4,
					$this->prefix . 'fnps_service_5'  => $fnps_service_5,
					$this->prefix . 'fnps_service_6'  => $fnps_service_6,
				] = get_post_meta(get_the_ID(), $this->prefix . 'fn_popular_services', true);
			}

			if (
				$fnps_service_1 && $fnps_service_2 && $fnps_service_3 && $fnps_service_4 && $fnps_service_5 && $fnps_service_6
			) {
				wp_localize_script('fn-popular-services-script', 'FNPS', array(
					'fnps_service_1' => $fnps_service_1,
					'fnps_service_2' => $fnps_service_2,
					'fnps_service_3' => $fnps_service_3,
					'fnps_service_4' => $fnps_service_4,
					'fnps_service_5' => $fnps_service_5,
					'fnps_service_6' => $fnps_service_6,
				));
			} else {
				wp_localize_script('fn-popular-services-script', 'FNPS', array());
			}
		});
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 * [Save meta box data]
	 */
	public function saveMetaBox($post_id)
	{
		if (
			!current_user_can('edit_others_pages')
			|| !wp_verify_nonce($_POST[$this->FNPS_nonce], $post_id . get_current_user_id())
		) {
			return;
		}

		$fnps_service_1  = $_POST['fnps_service_1'];
		$fnps_service_2  = $_POST['fnps_service_2'];
		$fnps_service_3  = $_POST['fnps_service_3'];
		$fnps_service_4  = $_POST['fnps_service_4'];
		$fnps_service_5  = $_POST['fnps_service_5'];
		$fnps_service_6  = $_POST['fnps_service_6'];

		$popular_services = array(
			$this->prefix . 'fnps_service_1'       => $fnps_service_1,
			$this->prefix . 'fnps_service_2'       => $fnps_service_2,
			$this->prefix . 'fnps_service_3'       => $fnps_service_3,
			$this->prefix . 'fnps_service_4'       => $fnps_service_4,
			$this->prefix . 'fnps_service_5'       => $fnps_service_5,
			$this->prefix . 'fnps_service_6'       => $fnps_service_6,
		);
		if (isset($_REQUEST['tag_ID'])) {
			update_term_meta($_REQUEST['tag_ID'], $this->prefix . 'fn_popular_services', $popular_services);
		} else {
			update_post_meta($post_id, $this->prefix . 'fn_popular_services', $popular_services);
		}
	}
}
