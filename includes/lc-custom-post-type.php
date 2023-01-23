<?
if ( ! defined( 'ABSPATH' ) ) exit;
function lc_create_cpt_socios() {
  $labels = array(
    'name' => _x( 'Socios', 'Post Type General Name', 'lc-tech' ),
    'singular_name'=> _x( 'Socios', 'Post Type Singular Name', 'lc-tech' ),
    'menu_name'=> __( 'Socios', 'lc-tech' ),
    'parent_item_colon'=> __( 'Socio Padre', 'lc-tech' ),
    'all_items'=> __( 'Todos las Socios', 'lc-tech' ),
    'view_item'=> __( 'Ver Socio', 'lc-tech' ),
    'add_new_item'=> __( 'Agregar Nuevo socio', 'lc-tech' ),
    'add_new'=> __( 'Agregar Nuevo', 'lc-tech' ),
    'edit_item'=> __( 'Editar Socio', 'lc-tech' ),
    'update_item'=> __( 'Actualizar Socio', 'lc-tech' ),
    'search_items'=> __( 'Buscar Socios', 'lc-tech' ),
    'not_found'=> __( 'No encontrado', 'lc-tech' ),
    'not_found_in_trash'=> __( 'No encontrado en la papelera', 'lc-tech' ),
  );
  $args = array(
    'labels'=> $labels,
    'supports'=> array( 'title', 'editor', 'excerpt', 'author', 'thumbnail'),
    'hierarchical'=> true,
    'public'=> true,
    'show_ui'=> true,
    'show_in_menu'=> true,
    'rewrite'=> array( 'slug' => 'socios'),
    'with_front' => false,
    'show_in_nav_menus'=> true,
    'show_in_admin_bar'=> true,
    'menu_position'=> 5,
    'menu_icon'=> 'dashicons-buddicons-buddypress-logo',
    'can_export'=> true,
    'has_archive'=> false,
    'exclude_from_search'=> true,
    'publicly_queryable'=> true,
    'capability_type'=> 'page',
    'map_meta_cap'=> true,
    'show_in_rest' => true,
  );
  register_post_type( 'Socios', $args );
}
add_action( 'init', 'lc_create_cpt_socios' );
?>