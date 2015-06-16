<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */
add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function your_prefix_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = '';
	// subtitle meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'subtitle_box',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => __( 'Subtitle', 'meta-box' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
			// TEXTAREA
			array(
				'name' => __( 'Subtitle', 'meta-box' ),
				'desc' => __( 'Subtitle that shows up on the single post page', 'meta-box' ),
				'id'   => "subtitle",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				// Default value (optional)
				// 'std'   => __( '', 'meta-box' ),
			),

		)
	);
	// external link meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'external_link_box',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => __( 'External Link', 'meta-box' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => __( 'Link URL', 'meta-box' ),
				// Field ID, i.e. the meta key
				'id'    => "external_link",
				// Field description (optional)
				'desc'  => __( 'Put external link here', 'meta-box' ),
				'type'  => 'text',
				// Default value (optional)
				// 'std'   => __( '', 'meta-box' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => __( 'Link name', 'meta-box' ),
				// Field ID, i.e. the meta key
				'id'    => "external_link_name",
				// Field description (optional)
				'desc'  => __( 'The name of the external link here', 'meta-box' ),
				'type'  => 'text',
				// Default value (optional)
				// 'std'   => __( 'Default text value', 'meta-box' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
		)
	);
	// legal text meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'legal_text_box',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => __( 'Include legal text for other company logos', 'meta-box' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
			// CHECKBOX
			array(
				'name' => __( 'Include legal text', 'meta-box' ),
				'id'   => "legal_checkbox",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),

		)
	);
	// by line metabox
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'by_line_box',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => __( 'By line', 'meta-box' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => __( 'By this author', 'meta-box' ),
				// Field ID, i.e. the meta key
				'id'    => "by_line",
				// Field description (optional)
				'type'  => 'text',
				// Default value (optional)
				// 'std'   => __( '', 'meta-box' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			)
		)
	);
	// article source metabox
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'article_source_box',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => __( 'Article source if applicable', 'meta-box' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => __( 'Article source', 'meta-box' ),
				// Field ID, i.e. the meta key
				'id'    => "article_source",
				// Field description (optional)
				'desc'  => __( 'example: WSJ, NYT, etc.', 'meta-box' ),
				'type'  => 'text',
				// Default value (optional)
				// 'std'   => __( '', 'meta-box' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			)
		)
	);


	return $meta_boxes;
}
