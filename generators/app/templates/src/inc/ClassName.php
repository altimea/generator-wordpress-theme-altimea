<?php

class <%= name_class %>
{

//	private $navHeadAction;

    public function __construct()
    {
        $this->init();
        $this->postTypes();
        $this->actions();
        $this->hideAdminBar();
        $this->addImagesSizes();
    }

    public function init()
    {
        add_action('init', [$this, 'themeRegisterMenus']);

        add_action('widgets_init', [$this, 'themeRemoveWidgets']);
        add_action('widgets_init', [$this, 'themeLoadSidebars']);
        add_action('widgets_init', [$this, 'themeLoadWidgets']);
        add_filter('upload_mimes', [$this, 'setMimeTypes']);
        // add_filter('body_class', [$this, 'bodyClasses']);

        // add_action('admin_menu', [$this, 'removeMetaBoxes']);
        // add_action('admin_init', [$this, 'addFacebookId']);

        //add custompost
        // add_action('init', array(new MyCustomPost(), 'register_post_type'));
    }

	/**
	 * Add input facebook_id to option [general]
	 * @return void
	 */
	public function addFacebookId() {
		register_setting( 'general', 'facebook_id', 'esc_attr' );
		add_settings_field( 'facebook_id', '<label for="facebook_id">Facebook Id</label>' , array(&$this, 'field_facebook_id_html') , 'general' );
	}
	/**
	 * html
	 * @return void
	 */
	public function field_facebook_id_html() {
		$value = get_option( 'facebook_id', '' );
		echo '<input type="number" id="facebook_id" name="facebook_id" value="' . $value . '" />';
	}

    /**
     * Create Custom Posts
     */
    public function postTypes()
    {
//        $this->custom_post_type = new MyCustomPost();
    }

    /**
     * Create actions
     */
    public function actions()
    {
//        $this->navHeadAction = new NavHeadAction();
    }

	/**
	 * Remove metabox fields for all users
	 */
	public function removeMetaBoxes() {
		// post
		remove_meta_box( 'postcustom', 'post', 'normal' );
		// remove_meta_box( 'postexcerpt', 'post', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
		// page
		remove_meta_box( 'postcustom', 'page', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'page', 'normal' );
		remove_meta_box( 'commentsdiv', 'page', 'normal' );
		remove_meta_box( 'revisionsdiv', 'page', 'normal' );
		remove_meta_box( 'authordiv' , 'page' , 'normal' );
	}

    /**
     * Register Menus
     */
    public function themeRegisterMenus()
    {
        register_nav_menus(
            array(
                'menu-primary' => __('Menú Principal', '<%= name %>-theme'),
                'menu-footer'  => __('Menú Footer', '<%= name %>-theme')
            )
        );
    }

    /**
     * Hide admin bar in front
     */
    public function hideAdminBar() {
        show_admin_bar(false);
    }

    public function addImagesSizes() {
        // Add support thumbnail
        add_theme_support('post-thumbnails');
        add_theme_support( 'title-tag' ); // show title on theme automatic (read documentation)

        // Custom sizes
        add_image_size( 'thumbnail_380', 380 );
        add_image_size( 'thumbnail_480', 480 );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		// add_theme_support( 'customize-selective-refresh-widgets' );

    }

    /**
     * Register Widgets
     */
    public function themeLoadSidebars()
    {
//        register_sidebar(array(
//            'name'          => __('Catálogos de Marcas', 'lbel'),
//            'id'            => 'lbel-catalog-brands',
//            'description'   => __('', 'lbel'),
//            'before_widget' => '',
//            'after_widget'  => '',
//            'before_title'  => '<h3 class="promoapp-title upper">',
//            'after_title'   => '</h3>',
//        ));
		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', '<%= name %>-theme' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', '<%= name %>-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
    }

    public function themeLoadWidgets() {
        //register_widget( 'LbelBrandsCatalogWidget' );
    }

    /**
	   * Remove Widgets
     */
    public function themeRemoveWidgets()
    {
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Media_Audio');
		unregister_widget('WP_Widget_Media_Image');
		unregister_widget('WP_Widget_Media_Video');
		unregister_widget('WP_Widget_Media_Gallery');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
		// unregister_widget('WP_Widget_Custom_HTML');
    }

    /**
     * Add support format svg upload image
     * @param $mimes
     * @return Array
     */
    public function setMimeTypes($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

	/**
	 * @return mixed
	 */
	public function getMenuTypeMetaBox()
	{
//		return $this->navHeadAction;
	}

    /**
     * @return mixed
     */
    public function getMyCustomPosts()
    {
//        return $this->custom_post_type;
    }

    public function bodyClasses( $classes )
    {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		return $classes;
    }
}
