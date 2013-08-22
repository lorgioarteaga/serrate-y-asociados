<?php
/*****
Funciones para crear los custom field  o  entrada de datos personalizadas
***/
function custom_add_meta_box_eventos(){	
	add_meta_box( 'field_contact_events', __('Detalle de Contactos','dc'), 'field_contact_events', 'event', 'side', 'high'); 
}
add_action('add_meta_boxes', 'custom_add_meta_box_eventos');

/*****************************************************************************/
/*
Funcion que nos permite adicionar elemento de entrada personalizadas de caracter de contacto para el evento
*/
function field_contact_events($post){
	 
	wp_nonce_field('save_field_contact_events', 'save_field_contact_events'); 
	 $eventos_costo	=	_get_post_meta($post->ID, '_eventos_costo'); 
	$eventos_contactos	=	_get_post_meta($post->ID, '_eventos_contactos'); 
?>
<div class="wrap">
    <table class="form-table widefat custom-table-options">		
        <tr>
        	<td> 
                <label><?php _e('Ingrese los contactos', 'dlal'); ?></label>	<br />	    
                <textarea name="eventos_contactos"  rows="6"  style="width:85%"><?php echo  $eventos_contactos;?></textarea><br />
                <span class="description"><?php _e('Ex.: telefono,  email, etc.', 'dlal'); ?></span>                  
                <br />  
                 <label><?php _e('Costo por persona', 'srr'); ?></label>	<br />	    
                <textarea name="eventos_costo"  rows="1"  style="width:85%"><?php echo  $eventos_costo;?></textarea><br />
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
	 update_post_meta($post_id, '_eventos_costo', $_POST['eventos_costo']);
	update_post_meta($post_id, '_eventos_contactos', $_POST['eventos_contactos']); 
}
add_action('save_post', 'field_contact_events_save');
/*****************************************************************************/

/*
referencia
http://trentrichardson.com/examples/timepicker/#basic_examples
*/