<?php
/*****
fuuncion que nos permite crear el post type eventos en el sistema de wordpress
******/
function create_eventos(){
	//if (current_user_can('administrator'))
	//{ // with this condition  only  admin  can see the eventos
	$slug = 'eventos';
	$name = 'eventos';
		register_post_type( $slug, array(	'labels' => array(	'name' 			=> __($name ),
																'singular_name' => __($name ),
																'add_new' 		=> __( 'Crear '.$name  ),
																'add_new_item' 	=> __( 'Crear '.$name  ),
																'not_found' 	=> __( 'No se Encontro '.$name  ),
															),
											'public' 				=> true,
											'show_ui' 				=> true,
											'menu_position' 		=> 15,
											'publicly_queryable' 	=> true,
											'can_export' 			=> true, 
											'exclude_from_search' 	=> false,
											'hierarchical'			=> false,
											'supports' 				=> array('title', 'editor', 'page-attributes', 'thumbnail'),
											'rewrite' 				=> array(	'slug' => $slug,
																				'with_front' => false
																			),
											'has_archive' => true, 								
											'capability_type' => 'post', 										 
											)
							);						
	flush_rewrite_rules(); 
}
add_action('init','create_eventos'); 


/*****
Funciones para crear los custom field  o  entrada de datos personalizadas
***/

function custom_add_meta_box_eventos(){	
	add_meta_box( 'field_contact_events', __('Detalle de Contactos','dc'), 'field_contact_events', 'eventos', 'normal', 'high');
	add_meta_box( 'field_categoria_event', __('Categorias Eventos','dc'), 'field_categoria_event', 'eventos', 'side', 'high');
	add_meta_box( 'field_horarios_events', __('Detalle Horarios','dc'), 'field_horarios_events', 'eventos', 'side', 'high');
}
add_action('add_meta_boxes', 'custom_add_meta_box_eventos');

/*****************************************************************************/
/*
Funcion que nos permite adicionar elemento de entrada personalizadas de caracter de contacto para el evento
*/
function field_contact_events($post){
	 
	wp_nonce_field('save_field_contact_events', 'save_field_contact_events'); 
	
	$eventos_nombre_lugar	=	_get_post_meta($post->ID, '_eventos_nombre_lugar');
	$eventos_direccion		=	_get_post_meta($post->ID, '_eventos_direccion');
	$eventos_contactos	=	_get_post_meta($post->ID, '_eventos_contactos'); 
?>
<div class="wrap">
    <table class="form-table widefat custom-table-options">		
        <tr>
        	<td>      
                <label><?php _e('Nombre del lugar', 'srr'); ?></label>	<br />	    
                <textarea name="eventos_nombre_lugar"  rows="2"  style="width:85%"><?php echo  $eventos_nombre_lugar;?></textarea><br />
                <span class="description"><?php _e('Ingresa el nombre donde se llevara  a cabo el evento Ex.: Manzana 1', 'srr'); ?></span>
				<br />
                <label><?php _e('Ubicacion (Direccion)', 'srr'); ?></label>	<br />	    
                <textarea name="eventos_direccion"  rows="2"  style="width:85%"><?php echo  $eventos_direccion;?></textarea><br />
                <span class="description"><?php _e('Ex.:Av. Cristo Redentor Santa Cruz de la Sierra, Bolivia', 'dlal'); ?></span>                  
                <br />
                <label><?php _e('Ingrese los contactos', 'dlal'); ?></label>	<br />	    
                <textarea name="eventos_contactos"  rows="6"  style="width:85%"><?php echo  $eventos_contactos;?></textarea><br />
                <span class="description"><?php _e('Ex.: telefono,  email, etc.', 'dlal'); ?></span>                  
                <br />     
            </td>
        </tr> 
	</table>
	</div>
<?php
	
}
/*
Funcion que permite almacenar los datos de las entradas creadas con la funcion de arriba
*/
function field_contact_events_save($post_id){ 
	if (isset($_POST['save_field_contact_events'])){
		if ( !wp_verify_nonce($_POST['save_field_contact_events'], 'save_field_contact_events')) {
			  return $post_id;
		}
	} else {
		return $post_id;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
	  return $post_id;
	if ('page' == $_POST['post_type']) {
	  if (!current_user_can('edit_page', $post_id))
		return $post_id;
	} else {
	  if (!current_user_can('edit_post', $post_id))
		return $post_id;
	} 
	
	
	update_post_meta($post_id, '_eventos_nombre_lugar', $_POST['eventos_nombre_lugar']);	
	update_post_meta($post_id, '_eventos_direccion', $_POST['eventos_direccion']);	
	update_post_meta($post_id, '_eventos_contactos', $_POST['eventos_contactos']); 
}
add_action('save_post', 'field_contact_events_save');
/*****************************************************************************/
/*
Funcion que nos permite adicionar elemento de entrada de categorias de eventos
*/
function field_categoria_event($post){
	wp_nonce_field('save_field_categoria_events', 'save_field_categoria_events'); 
	$eventos_costo	=	_get_post_meta($post->ID, '_eventos_costo'); 
?>
<div class="wrap">
    <table class="form-table widefat custom-table-options">		
        <tr>
        	<td>      
                <label><?php _e('Costo por persona', 'srr'); ?></label>	<br />	    
                <textarea name="eventos_costo"  rows="2"  style="width:85%"><?php echo  $eventos_costo;?></textarea><br />
                <span class="description"><?php _e('Ingresa el costo  Ex.: 150 Bs', 'srr'); ?></span> 
            </td>
        </tr> 
	</table>
	</div>
<?php
}
/*
Funcion que permite almacenar los datos de las entradas creadas con la funcion de arriba
*/
function field_categoria_event_save($post_id){
	if (isset($_POST['save_field_categoria_events'])){
		if ( !wp_verify_nonce($_POST['save_field_categoria_events'], 'save_field_categoria_events')) {
			  return $post_id;
		}
	} else {
		return $post_id;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
	  return $post_id;
	if ('page' == $_POST['post_type']) {
	  if (!current_user_can('edit_page', $post_id))
		return $post_id;
	} else {
	  if (!current_user_can('edit_post', $post_id))
		return $post_id;
	} 
	update_post_meta($post_id, '_eventos_costo', $_POST['eventos_costo']);
}
add_action('save_post', 'field_categoria_event_save');
/*****************************************************************************/
/*
Funcion que nos permite adicionar elemento de entrada referente a los horarios de un evento
*/
function field_horarios_events($post){
	wp_nonce_field('save_field_horarios_events', 'save_field_horarios_events'); 
	$eventos_fecha	=	_get_post_meta($post->ID, '_eventos_fecha');
	$eventos_hora_inicio	=	_get_post_meta($post->ID, '_eventos_hora_inicio'); 
	$eventos_hora_fin	=	_get_post_meta($post->ID, '_eventos_hora_fin');
?>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script language="javascript">
jQuery(document).ready(function(){
	jQuery(function() {
		jQuery( "#fecha_event" ).datepicker();
	});	
});
</script>
<div class="wrap">
    <table class="form-table widefat custom-table-options">		
        <tr>
        	<td>      
                <label><?php _e('Fecha del evento', 'srr'); ?></label>	<br />	    
                <input id="fecha_event" type="text" name="eventos_fecha" style="width:85%"  value="<?php echo  $eventos_fecha;?> "/><br />
                <span class="description"><?php _e('Ingresa la fecha   Ex.: 15/12/2013', 'srr'); ?></span> 
                <br>
                <label><?php _e('Hora Inicio', 'srr'); ?></label>	<br />	    
                <input type="text" name="eventos_hora_inicio" style="width:85%"  value="<?php echo $eventos_hora_inicio;?> "/><br />
                <span class="description"><?php _e('Ex.: 14:00', 'srr'); ?></span> 
                 <br>
                <label><?php _e('Hora Fin', 'srr'); ?></label>	<br />	    
                <input type="text" name="eventos_hora_fin" style="width:85%"  value="<?php echo  $eventos_hora_fin;?> "/><br />
                <span class="description"><?php _e('Ex.: 15:30', 'srr'); ?></span> 
            </td>
        </tr> 
	</table>
	</div>
<?php
}

/*
Funcion que permite almacenar los datos de las entradas creadas con la funcion de arriba
*/
function field_horarios_events_save($post_id){
	if (isset($_POST['save_field_horarios_events'])){
		if ( !wp_verify_nonce($_POST['save_field_horarios_events'], 'save_field_horarios_events')) {
			  return $post_id;
		}
	} else {
		return $post_id;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
	  return $post_id;
	if ('page' == $_POST['post_type']) {
	  if (!current_user_can('edit_page', $post_id))
		return $post_id;
	} else {
	  if (!current_user_can('edit_post', $post_id))
		return $post_id;
	} 
	update_post_meta($post_id, '_eventos_fecha', $_POST['eventos_fecha']);	
	update_post_meta($post_id, '_eventos_hora_inicio', $_POST['eventos_hora_inicio']);
	update_post_meta($post_id, '_eventos_hora_fin', $_POST['eventos_hora_fin']);
}
add_action('save_post', 'field_horarios_events_save');
/*****************************************************************************/


/*
referencia
http://trentrichardson.com/examples/timepicker/#basic_examples
*/