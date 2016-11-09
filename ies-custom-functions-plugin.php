<?php
/*
Plugin Name: IES CPT-etc Site Plugin for ies.ncsu.edu
Description: Site specific code changes for ies.ncsu.edu
Version: 1.0.4
Author: ncjones4@ncsu.edu
*/



/***************************************
* Create IES custom taxonomies Functions
* Note: Register taxos first so Courses
* CPT has them when created below
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
    'menu_icon'          => 'dashicons-list-view',
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'tags', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'industry', 'location', 'post_tag' ),
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


// "STAFF" Custom Post Type
function create_staff_posttype() {

// Set UI labels for Course CPT
  $labels = array(
    'name'                => _x( 'Staff', 'Post Type General Name' ),
    'singular_name'       => _x( 'Staff', 'Post Type Singular Name' ),
    'menu_name'           => __( 'Staff' ),
    'all_items'           => __( 'All Staff' ),
    'view_item'           => __( 'View Staff' ),
    'add_new_item'        => __( 'Add New Staff' ),
    'add_new'             => __( 'Add New' ),
    'edit_item'           => __( 'Edit Staff' ),
    'update_item'         => __( 'Update Staff' ),
    'search_items'        => __( 'Search Staff' ),
    'not_found'           => __( 'Not Found' ),
    'not_found_in_trash'  => __( 'Not found in Trash' ),
  );
  
// Set options for Staff CPT 
  $args = array(
    'label'               => __( 'staff' ),
    'description'         => __( 'IES Staff list' ),
    'labels'              => $labels,
    'menu_icon'          => 'dashicons-admin-users',
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
    'menu_position'       => 6,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post', //or page
  );

// Register Staff CPT
  register_post_type( 'staff', $args );

}

// The CPT INIT hook
add_action( 'init', 'create_staff_posttype', 0 );



/* Attach custom taxonomies "Location" & "Industry" to pages content type
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

/*** Add Related Posts by Taxonomy Plugin Custom Filters
*  mainly limit all shortcode Related Posts to Solutions category posts
*  plugin info: http://keesiemeijer.wordpress.com/related-posts-by-taxonomy/
*/

add_filter( 'related_posts_by_taxonomy_shortcode_atts', 'related_posts_exclude_terms_strict' );

function related_posts_exclude_terms_strict( $args ) {
  global $wpdb;

  if ( empty( $args['exclude_terms'] )  ) {
    return $args;
  }

  // sanitize the excluded terms
  $exclude_terms = explode( ',', (string) $args['exclude_terms'] );
  $exclude_terms = array_filter( array_map( 'intval', $exclude_terms ) );
  $exclude_terms = array_values( array_unique( $exclude_terms ) );

  $term_ids_sql = "tt.term_id IN (" . implode( ', ', $exclude_terms ) . ")";

  $query = "
    SELECT p.ID FROM $wpdb->posts p
    LEFT JOIN $wpdb->term_relationships t ON (p.ID = t.object_id)
    WHERE exists (
          SELECT tt.term_taxonomy_id FROM $wpdb->term_taxonomy tt
          WHERE tt.term_taxonomy_id = t.term_taxonomy_id
          and {$term_ids_sql}
      ) GROUP BY p.ID
  ";

  // get post ids with the excluded terms
  $results = $wpdb->get_col( $query );

  if ( !empty( $results ) ) {
    $args['exclude_posts'] = $results;
  }

  // return arguments with the excluded posts
  return $args;
}



//WP Query Orderby Taxonomy Term Name 
// from https://gist.github.com/jayarnielsen/12f3a586900aa6759639

add_filter('posts_clauses', 'posts_clauses_with_tax', 10, 2);
function posts_clauses_with_tax( $clauses, $wp_query ) {
  global $wpdb;
  //array of sortable taxonomies
  $taxonomies = array('location', 'industry');
  if (isset($wp_query->query['orderby']) && in_array($wp_query->query['orderby'], $taxonomies)) {
    $clauses['join'] .= "
      LEFT OUTER JOIN {$wpdb->term_relationships} AS rel2 ON {$wpdb->posts}.ID = rel2.object_id
      LEFT OUTER JOIN {$wpdb->term_taxonomy} AS tax2 ON rel2.term_taxonomy_id = tax2.term_taxonomy_id
      LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
    ";
    $clauses['where'] .= " AND (taxonomy = '{$wp_query->query['orderby']}' OR taxonomy IS NULL)";
    $clauses['groupby'] = "rel2.object_id";
    $clauses['orderby']  = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
    $clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
  }
  return $clauses;
}




/**** END  ****/
?>