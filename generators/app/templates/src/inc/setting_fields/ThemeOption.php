<?php

class ThemeOption
{

	private static $prefix = 'mltheme';

	private $key_show;

	private $key_facebook;

	private $key_instagram;

	private $key_youtube;

	private $key_spotify;

	public function __construct()
	{
		// set values
		$this->key_show = self::$prefix.'_field_option_show';
		$this->key_facebook = self::$prefix.'_field_option_facebook';
		$this->key_instagram = self::$prefix.'_field_option_instagram';
		$this->key_youtube = self::$prefix.'_field_option_youtube';
		$this->key_spotify = self::$prefix.'_field_option_spotify';

		$this->init();
	}

	public function init()
	{
		add_action("admin_menu", array( $this, 'add_theme_menu_item' ));
		add_action('admin_init', array( $this, 'test_theme_settings' ));
	}

	public function add_theme_menu_item() {
		add_theme_page(
			"Tema Opciones General",
			"Tema Opciones General",
			"manage_options",
			"theme-options",
			array($this, "theme_option_page"),
			null,
			99
		);
	}

	public function theme_option_page() {
	?>
		<div class="wrap">
		<h1>Tema Opciones General</h1>
		<form method="post" action="options.php">
		<?php
			// display settings field on theme-option page
			settings_fields("theme-options-". self::$prefix);
			// display all sections for theme-options page
			do_settings_sections("theme-options");
			submit_button();
		?>
		</form>
		</div>
	<?php
	}

	public function theme_section_description(){
		echo ''; // fill html
	}

	/**
	 * Create Custom Posts
	 */
	public function test_theme_settings()
	{
		add_option($this->key_show, 1);// add theme option to database
		add_option($this->key_facebook, 'https://www.facebook.com/');
		add_option($this->key_instagram, 'https://www.instagram.com/');
		add_option($this->key_youtube, 'https://www.youtube.com/');
		add_option($this->key_spotify, 'https://www.spotify.com/');

		add_settings_section(
			'first_section',
			'Tema Opciones',
			array($this, 'theme_section_description'),
			'theme-options'
		);

		// add Input
		add_settings_field(
			$this->key_show,
			'Mostrar Redes Sociales',
			array($this, 'display_input_show'),
			'theme-options',
			'first_section'
		);//add settings field to the “first_section”

		register_setting(
			'theme-options-' . self::$prefix,
			$this->key_show
		);

		// add Input Facebook
		add_settings_field(
			$this->key_facebook,
			'Facebook URL',
			array($this, 'display_input_facebook'),
			'theme-options',
			'first_section'
		);
		register_setting(
			'theme-options-' . self::$prefix,
			$this->key_facebook
		);

		// add Input Instagram
		add_settings_field(
			$this->key_instagram,
			'Instagram URL',
			array($this, 'display_input_instagram'),
			'theme-options',
			'first_section'
		);
		register_setting(
			'theme-options-' . self::$prefix,
			$this->key_instagram
		);

		// add Input Youtube
		add_settings_field(
			$this->key_youtube,
			'Youtube URL',
			array($this, 'display_input_youtube'),
			'theme-options',
			'first_section'
		);
		register_setting(
			'theme-options-' . self::$prefix,
			$this->key_youtube
		);

		// add Input Spotify
		add_settings_field(
			$this->key_spotify,
			'Spotify URL',
			array($this, 'display_input_spotify'),
			'theme-options',
			'first_section'
		);
		register_setting(
			'theme-options-' . self::$prefix,
			$this->key_spotify
		);
	}

	function display_input_show(){
		$options = get_option( $this->key_show );

		echo '<input name="'. $this->key_show .'" id="'. $this->key_show .'" type="checkbox" value="1" class="code" ' . checked( 1, $options, false ) . ' /> ';
	}

	function display_input_instagram(){
		//php code to take input from text field for twitter URL.
		?>
		<input type="url" name="<?php echo $this->key_instagram; ?>" id="<?php echo $this->key_instagram; ?>" value="<?php echo get_option($this->key_instagram); ?>" />
		<?php
	}

	function display_input_facebook(){
		?>
		<input type="url" name="<?php echo $this->key_facebook; ?>" id="<?php echo $this->key_facebook; ?>" value="<?php echo get_option($this->key_facebook); ?>" />
		<?php
	}

	function display_input_youtube(){
		?>
		<input type="url" name="<?php echo $this->key_youtube; ?>" id="<?php echo $this->key_youtube; ?>" value="<?php echo get_option($this->key_youtube); ?>" />
		<?php
	}

	function display_input_spotify(){
		?>
		<input type="url" name="<?php echo $this->key_spotify; ?>" id="<?php echo $this->key_spotify; ?>" value="<?php echo get_option($this->key_spotify); ?>" />
		<?php
	}
}
