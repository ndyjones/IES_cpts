<?php
/*
Plugin Name: IES CPT-etc Site Plugin for ies.ncsu.edu
Description: Site specific code changes for ies.ncsu.edu
Version: 0.1
Author: ncjones4@ncsu.edu
*/


/******************************
* Create the IES CPTs Functions
*******************************/

// "COURSES" Custom Post Type
function create_course_posttype() {

// Set UI labels for Course CPT
	$labels = array(
		'name'                => _x( 'Courses', 'Post Type General Name' ),
		'singular_name'       => _x( 'Course', 'Post Type Singular Name' ),
		'menu_name'           => __( 'Courses' ),
		'parent_item_colon'   => __( 'Parent Course' ),
		'all_items'           => __( 'All Courses' ),
		'view_item'           => __( 'View Courses' ),
		'add_new_item'        => __( 'Add New Course' ),
		'add_new'             => __( 'Add New' ),
		'edit_item'           => __( 'Edit Course' ),
		'update_item'         => __( 'Update Course' ),
		'search_items'        => __( 'Search Course' ),
		'not_found'           => __( 'Not Found' ),
		'not_found_in_trash'  => __( 'Not found in Trash' ),
	);
	
// Set options for Course CPT	
	$args = array(
		'label'               => __( 'courses' ),
		'description'         => __( 'Course and Professional Development offerings' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'industry', 'location' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post', //or page
	);

// Register Courses CPT
	register_post_type( 'courses', $args );

}


// The CPT INIT hook
add_action( 'init', 'create_course_posttype', 0 );



/***************************************
* Create IES custom taxonomies Functions
****************************************/
function add_custom_taxonomies() {
// Add new "LOCATIONS" taxonomy to ALL Posts types
  register_taxonomy('location', 'post', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Locations', 'taxonomy general name' ),
      'singular_name' => _x( 'Location', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Locations' ),
      'all_items' => __( 'All Locations' ),
      'parent_item' => __( 'Parent Location' ),
      'parent_item_colon' => __( 'Parent Location:' ),
      'edit_item' => __( 'Edit Location' ),
      'update_item' => __( 'Update Location' ),
      'add_new_item' => __( 'Add New Location' ),
      'new_item_name' => __( 'New Location Name' ),
      'menu_name' => __( 'Locations' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'locations', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));

// Add new "INDUSTRY" taxonomy to ALL Posts types
  register_taxonomy('industry', 'post', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Industry', 'taxonomy general name' ),
      'singular_name' => _x( 'Industry', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Industries' ),
      'all_items' => __( 'All Industries' ),
      'parent_item' => __( 'Parent Industry' ),
      'parent_item_colon' => __( 'Parent Industry:' ),
      'edit_item' => __( 'Edit Industry' ),
      'update_item' => __( 'Update Industry' ),
      'add_new_item' => __( 'Add New Industry' ),
      'new_item_name' => __( 'New Industry Name' ),
      'menu_name' => __( 'Industries' ),
    ),
    // Control slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'industry', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));

} // End taxonomies

// The custom taxonomy INIT hook
add_action( 'init', 'add_custom_taxonomies', 0 );



/* Attach custom taxonomies "Location" & "Industry" to pages
* From Plugin Name: Post Tags and Categories for Pages
* Plugin URI: http://wpthemetutorial.com/plugins/post-tags-and-categories-for-pages/
* Description: Simply adds the stock Categories and Post Tags to your Pages.
* Version: 1.3
* Author: curtismchale
* Author URI: http://wpthemetutotial.com/about/
* License: GNU General Public License v2.0
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class PTCFP{

  function __construct(){

    add_action( 'init', array( $this, 'taxonomies_for_pages' ) );

    /**
     * Want to make sure that these query modifications don't
     * show on the admin side or we're going to get pages and
     * posts mixed in together when we click on a term
     * in the admin
     *
     * @since 1.0
     */
    if ( ! is_admin() ) {
      add_action( 'pre_get_posts', array( $this, 'category_archives' ) );
      add_action( 'pre_get_posts', array( $this, 'tags_archives' ) );
    } // ! is_admin

  } // __construct

  /**
   * Registers the taxonomy terms for the post type
   *
   * @since 1.0
   *
   * @uses register_taxonomy_for_object_type
   */
  function taxonomies_for_pages() {
      register_taxonomy_for_object_type( 'post_tag', 'page' );
      register_taxonomy_for_object_type( 'category', 'page' );
     // Give IES custom Industry taxonomy to pages too
      register_taxonomy_for_object_type( 'industry', 'page' ); 
    // Give Industry and Location to the Courses CPT
       register_taxonomy_for_object_type( 'industry', 'course' ); 
       register_taxonomy_for_object_type( 'location', 'course' );
  } // taxonomies_for_pages

  /**
   * Includes the tags in archive pages
   *
   * Modifies the query object to include pages
   * as well as posts in the items to be returned
   * on archive pages
   *
   * @since 1.0
   */
  function tags_archives( $wp_query ) {

    if ( $wp_query->get( 'tag' ) )
      $wp_query->set( 'post_type', 'any' );

  } // tags_archives

  /**
   * Includes the categories in archive pages
   *
   * Modifies the query object to include pages
   * as well as posts in the items to be returned
   * on archive pages
   *
   * @since 1.0
   */
  function category_archives( $wp_query ) {

    if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
      $wp_query->set( 'post_type', 'any' );

  } // category_archives

} // PTCFP

$ptcfp = new PTCFP();


/**** END  ****/
?>