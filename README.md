# IES Custom Post types and Taxonomies
A Custom post types &amp; taxonomies plugin for use by Industry Expansion Solutions on NC State Itecs multi-site wordpress enviroment.
## Post Types
  * Courses
  * Staff

  
## Taxonomies
  * Industries
  * Locations

##Other notes
Taxonomies are used to generate related content widgets to cross populate Industries and CPT-related posts throughout site.
Uses Post Tags and Categories for Pages plugin (http://wpthemetutorial.com/plugins/post-tags-and-categories-for-pages/) to attach cats and tags to pages for related content widgets in pages & post content as well.
Staff CPT declared to create a linked resource for posts, pages & course content.
  
##Contact

Contact Nicolle Jones, NC State Univeristy (nicolle_jones@ncsu.edu) for information or questions.

== Changelog ==

= 1.0.3 =
* Added meta fields to wp search query to try and fix the custom course search.

= 1.0.2 =
* Moved the Orderby Taxonomy Term Name filter to the plugin file as it's used for the IES Specific custom taxonomies and cpts.
* Added Courses cpt filter to return course-search.php for all 'courses' post_type wp_query searches.

= 1.0.1 = 
* Added support for tags to Courses custom post type.

= 1.0 =
Initial release
