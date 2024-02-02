<?php

class FNPS_acf_field extends acf_field
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
	private $FNPS_domain = 'fnps-popular-services';
	private $FNPS_nonce = 'fn-popular-services-nonce';

	private $slick_version = '1.8.0';
	private $bootstrap_version = '5.1.3';
	private $popper_version = '2.9.2';

	public function __construct()
	{
		$this->name = 'FNPS_field';

		$this->label = __('Popular Services', $this->FNPS_domain);

		$this->category = __('Popular Services', $this->FNPS_domain);

		$this->defaults = array(
			'value' => true,
		);

		$this->l10n = array(
			'error' => "enter valid input"
		);

		parent::__construct();
	}

	function render_field_settings($field)
	{
		$select_options = [
			1 => __('enable', $this->FNPS_domain),
			2 => __('disable', $this->FNPS_domain)
		];
		acf_render_field_setting($field, array(
			'label'        => __('enable', $this->FNPS_domain),
			'instructions' => __('enable popular services', $this->FNPS_domain),
			'key'          => 'FNPS_enable',
			'type'         => 'select',
			'name'         => 'FNPS',
			'choices'      => $select_options,
			'value'        => 1
		));
	}

	function render_field($field)
	{
		$this->renderMetaBox();
	}

	/**
	 * @param WP_Post $post Current save/edit post object
	 *
	 * @return void
	 */
	public function renderMetaBox()
	{
		$fs_services = get_terms(
			array(
				'taxonomy'   => 'service_type',
				'hide_empty' => false,
			)
		);
		include(FNPS_CORE_PATH . 'view/metabox_view.php');
	}
}

new FNPS_acf_field();
