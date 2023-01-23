<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class LcCreateTaxonomy {

  public function createSectores() {
    $labels = array(
      'name'              => _x( 'Sector', 'Tipo de sesión' ),
      'singular_name'     => _x( 'Sector', 'Tipo de sesión' ),
      'search_items'      => __( 'Buscar sector' ),
      'all_items'         => __( 'Todos los sectores' ),
      'parent_item'       => __( 'Sector Padre' ),
      'parent_item_colon' => __( 'Sector Padre:' ),
      'edit_item'         => __( 'Editar sector' ),
      'update_item'       => __( 'Actualizar sector' ),
      'add_new_item'      => __( 'Agregar Nuevo sector' ),
      'new_item_name'     => __( 'Nuevo sector' ),
      'menu_name'         => __( 'Sector' ),
    );
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_in_rest'          => true,
      'show_ui'           => true,
      'has_archive'           => false,
      'with_front' => false,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite' => array( 'slug' => 'sector' ),
    );
    register_taxonomy( 'sector', array( 'socios'), $args );
  }
  
  public function createActividades() {
    $labels = array(
      'name'              => _x( 'Actividades', 'Tipo de sesión' ),
      'singular_name'     => _x( 'Actividades', 'Tipo de sesión' ),
      'search_items'      => __( 'Buscar Actividades' ),
      'all_items'         => __( 'Todas las Actividades' ),
      'parent_item'       => __( 'Actividad Padre' ),
      'parent_item_colon' => __( 'Actividad Padre:' ),
      'edit_item'         => __( 'Editar Actividad' ),
      'update_item'       => __( 'Actualizar Actividad' ),
      'add_new_item'      => __( 'Agregar Nueva Actividad' ),
      'new_item_name'     => __( 'Nueva Actividad' ),
      'menu_name'         => __( 'Actividades' ),
    );
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_in_rest'          => true,
      'show_ui'           => true,
      'has_archive'           => false,
      'with_front' => false,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite' => array( 'slug' => 'sector' ),
    );
    register_taxonomy( 'actividades', array( 'socios'), $args );
  }

  public function createTipo() {
    $labels = array(
      'name'              => _x( 'Tipo de socio', 'Tipo de sesión' ),
      'singular_name'     => _x( 'Tipo de socio', 'Tipo de sesión' ),
      'search_items'      => __( 'Buscar Tipo de socio' ),
      'all_items'         => __( 'Todos los tipos de socio' ),
      'parent_item'       => __( 'Tipo de socio Padre' ),
      'parent_item_colon' => __( 'Tipo de socio Padre:' ),
      'edit_item'         => __( 'Editar tipo de socio' ),
      'update_item'       => __( 'Actualizar tipo de socio' ),
      'add_new_item'      => __( 'Agregar Nuevo tipo de socio' ),
      'new_item_name'     => __( 'Nuevo Tipo de socio' ),
      'menu_name'         => __( 'Tipo de socio' ),
    );
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_in_rest'          => true,
      'show_ui'           => true,
      'has_archive'           => false,
      'with_front' => false,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite' => array( 'slug' => 'sector' ),
    );
    register_taxonomy( 'tipo_socio', array( 'socios'), $args );
  }

}