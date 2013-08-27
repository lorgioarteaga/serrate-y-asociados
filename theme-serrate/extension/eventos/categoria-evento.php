<?
/* Taxonomia personal para las categorias de eventos  by Lorgio*/ 
add_action( 'init', 'create_taxonomies_category_eventos', 0 );  
function create_taxonomies_category_eventos(){
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(	'name' => _x( 'Categoria eventos', 'taxonomy general name' ),
					'singular_name' => _x( 'Categoria eventos', 'taxonomy singular name' ),
					'search_items' =>  __( 'Buscar Categoria eventos' ),
					'all_items' => __( 'Todas Categoia eventos' ),
					'parent_item' => __( 'Padre Categoria eventos' ),
					'parent_item_colon' => __( 'Padre Categoria eventos:' ),
					'edit_item' => __( 'Edit Categoria eventos' ), 
					'update_item' => __( 'Update Categoria eventos' ),
					'add_new_item' => __( 'Add New Categoria eventos' ),
					'new_item_name' => __( 'Nueva Categoria Name' ),
					'menu_name' => __( 'Categoria eventos' ),
				  ); 	

  register_taxonomy('category-eventos',
  					array('eventos'), 
					array(	'hierarchical' => true,
							'labels' => $labels,
							'show_ui' => true,
							'query_var' => true,
							'rewrite' => true,
					  )
				); 
}