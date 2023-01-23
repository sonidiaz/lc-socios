<?
/*
Plugin Name: Nuestros Socios
Plugin URI:
Description: Custom Post Type para agrupar a los socios.
Version:     0.3
Author:      Lacabrera.eco
Author URI:  https://lacabrera.eco
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
if ( ! defined( 'ABSPATH' ) ) exit;


require_once plugin_dir_path(__FILE__) . 'includes/lc-class.php';
require_once plugin_dir_path(__FILE__) . 'includes/lc-custom-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/lc-taxonomy.php';

add_action('init', function() {
  $taxonomys = new LcCreateTaxonomy();
  $LcSocios = new LcSocios();
  $LcSocios->loadScriptSociosModule();

  $LcSocios->createMetaBox();
  $taxonomys->createSectores();
  $taxonomys->createTipo();
  $taxonomys->createActividades();
});

function getPostContent () {
  $postActividad = $_POST['actividad'];
  $postSector = $_POST['sector'];
  $tipoSocio = $_POST['tipo_socio'];
  $currentPage = $_POST['current_page'];
  $listado = [];
  
  $tax_query = array(
    'relation' => 'AND',
      array(
        'taxonomy' => 'sector',
        'field'    => 'slug',
        'terms'    => ($postSector === 'todos' || $postSector === '') ? array("Industria", "Construcción","Servicios", "Comercio") : $postSector,
      ),
      // array(
      //   'taxonomy' => 'actividades',
      //   'field'    => 'slug',
      //   'terms'    => $postActividad,
      // ),
      array(
        'taxonomy' => 'tipo_socio',
        'field'    => 'slug',
        'terms'    => ($tipoSocio === 'todos' || $tipoSocio === '') ? array("Profesional", "Empresa") : $tipoSocio,
      ),
    );
    $args = array(
      'post_type' => 'socios',
      'posts_per_page' => -1,
      'paged' => $currentPage,
      'orderbyby' => 'DESC',
      'tax_query' => $tax_query
    );

  if($postSector === '' && $tipoSocio === '') {
    unset($args['tax_query']);
  }
  $posts = get_posts($args);

  foreach ( $posts as $post ) {
    setup_postdata( $post );
    $listTermSector = get_the_terms($post->ID, 'sector');
    $listTermActividades = get_the_terms($post->ID, 'actividades');
    $listTermTipoSocio = get_the_terms($post->ID, 'tipo_socio');
    $listTerms = [];
    $listTermsAct = [];
    $listTermsTipo = [];
    foreach($listTermSector as $lc_terms) {
      $listTerms[] = array(
        "id" => $lc_terms->term_id,
        "name" => $lc_terms->name, 
        "slug" => $lc_terms->slug
      );
    }
    foreach($listTermTipoSocio as $lc_terms) {
      $listTermsTipo[] = array(
        "id" => $lc_terms->term_id,
        "name" => $lc_terms->name, 
        "slug" => $lc_terms->slug
      );
    }
    foreach($listTermActividades as $lc_terms) {
      $listTermsAct[] = array(
        "id" => $lc_terms->term_id,
        "name" => $lc_terms->name, 
        "slug" => $lc_terms->slug
      );
    }
    $listado[] = array(
        "id" => $post->ID,
        "post_title" => $post->post_title,
        "post_content" => $post->post_content,
        "post_excerpt" => get_the_excerpt($post->ID),
        "image" => get_the_post_thumbnail_url($post->ID),
        "permalink" => get_permalink($post->ID),
        "address" => get_post_meta($post->ID, 'lc_fields_socios_address', true),
        "email" => get_post_meta($post->ID, 'lc_fields_socios_email', true),
        "phone" => get_post_meta($post->ID, 'lc_fields_socios_phone', true),
        "logo" => get_post_meta($post->ID, 'lc_fields_socios_logo', true),
        "maps" => get_post_meta($post->ID, 'lc_fields_socios_maps', true),
        "terminoSector" => $listTerms,
        "terminoTipo" => $listTermsTipo,
        "terminoActividad" => $listTermsAct
    );
  }

  header("Content-type: application/json");
  echo json_encode( array("data" => $listado, "total" => count($posts)));
  die;
}
add_action('wp_ajax_nopriv_getPostContent', 'getPostContent');
add_action('wp_ajax_getPostContent', 'getPostContent');

register_activation_hook(__FILE__, 'rewrite_flush');
?>