<?php

class MyCustomPost
{
	public static $post_type_name = 'artistas'; // Custom post name

	/**
	* Create custom post
	*/
	public function register_post_type()
	{
		// Etiquetas para el Post Type
		$labels = array(
			'name'                => _x('Artistas', 'Post Type General Name', '<%= name %>-theme'),
			'singular_name'       => _x('Artista', 'Post Type Singular Name', '<%= name %>-theme'),
			'menu_name'           => __('Artistas', '<%= name %>-theme'),
			'parent_item_colon'   => __('Artista Father', '<%= name %>-theme'),
			'all_items'           => __('Todos los Artistas', '<%= name %>-theme'),
			'view_item'           => __('Ver Artista', '<%= name %>-theme'),
			'add_new_item'        => __('Agregar Artista', '<%= name %>-theme'),
			'add_new'             => __('Agregar Artista', '<%= name %>-theme'),
			'edit_item'           => __('Editar Artista', '<%= name %>-theme'),
			'update_item'         => __('Actualizar Artista', '<%= name %>-theme'),
			'search_items'        => __('Buscar Artista', '<%= name %>-theme'),
			'not_found'           => __('Ninguna entrada', '<%= name %>-theme'),
			'not_found_in_trash'  => __('Ninguna entrada encontrada en la papelera.', '<%= name %>-theme'),
		);

		// Otras opciones para el post type
		$options = array(
			'label'               => __('Artistas', '<%= name %>-theme'),
			'description'         => __('Artistas', '<%= name %>-theme'),
			'labels'              => $labels,
			// Todo lo que soporta este post type
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			/* Un Post Type hierarchical es como las paginas y puede tener padres e hijos.
			* Uno sin hierarchical es como los posts
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-admin-post',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		// Check that the post type doesn't already exist.
		if ( ! post_type_exists( self::$post_type_name ) ) {

			// Register the post type.
			register_post_type( self::$post_type_name, $options );
		}
	}
}
