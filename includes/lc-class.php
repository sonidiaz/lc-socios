<?
if(file_exists(dirname(__FILE__).'../cmb2/init.php')) {
  require_once dirname(__FILE__).'../cmb2/init.php';
};
class LcSocios {
    // public $socios;
    // function getAllSocios($socios) {
    //   $this->$socios = $socios;
    // }
  
    public function createMetaBox() {
      function socios_fields() {
        $prefix = 'lc_fields_socios_';
        $cmb_socios = new_cmb2_box( array(
          'id'            => $prefix.'metabox',
          'title'         => esc_html__( 'Datos del socio', 'cmb2' ),
          'object_types'  => array( 'socios' ), // Post type
        ) );
        $cmb_socios->add_field( array(
          'name'       => esc_html__( 'Teléfono', 'cmb2' ),
          'id'         => $prefix.'phone',
          'type'       => 'text',
        ) );
        $cmb_socios->add_field( array(
          'name'       => esc_html__( 'Email', 'cmb2' ),
          'id'         => $prefix.'email',
          'type'       => 'text',
        ) );
        $cmb_socios->add_field( array(
          'name'       => esc_html__( 'Web', 'cmb2' ),
          'id'         => $prefix.'web',
          'type'       => 'text',
        ) );
        $cmb_socios->add_field( array(
          'name'       => esc_html__( 'Dirección', 'cmb2' ),
          'id'         => $prefix.'address',
          'type'       => 'text',
        ) );
        $cmb_socios->add_field( array(
          'name'       => esc_html__( 'Logo', 'cmb2' ),
          'desc' => esc_html__( 'Sube tu foto o pega la url.', 'cmb2' ),
          'id'         => $prefix.'logo',
          'type'       => 'file',
        ) );
        $cmb_socios->add_field( array(
          'name'       => esc_html__( 'Google Maps', 'cmb2' ),
          'desc' => esc_html__( 'Pega el link de Google Maps del negocio', 'cmb2' ),
          'id'         => $prefix.'maps',
          'type'       => 'text',
        ) );
      }
      add_action( 'cmb2_admin_init', 'socios_fields' );
    }
    public function loadScriptSociosModule() {
      function lcLoadScriptModule() {
        $terminosSector = [];
        $terminosActividad = [];
        $terminosTipoSocio = [];
        
        $termsSector = get_terms( array(
          'taxonomy' => 'sector',
          'order' => 'DESC',
          'hide_empty' => true,
        ));
        $termsTipoSocio = get_terms( array(
            'taxonomy' => 'tipo_socio',
            'order' => 'DESC',
            'hide_empty' => true,
        ));
        $termsActividad = get_terms( array(
            'taxonomy' => 'actividades',
            'order' => 'DESC',
            'hide_empty' => true,
        ));
        foreach ( $termsSector as $post ){
          array_push($terminosSector, array("value" => $post->slug, "label" => $post->name));
        }
        foreach ( $termsTipoSocio as $post ){
          array_push($terminosTipoSocio, array("value" => $post->slug, "label" => $post->name));
        }
        foreach ( $termsActividad as $postActividad ){
          array_push($terminosActividad, array("value" => $postActividad->slug, "label" => $postActividad->name));
        }
        
        $output = '';
        ob_start();
        ?>
          <div id="root"></div>
        <?
        $output = ob_get_clean();
        $buildpro = str_contains($_SERVER['HTTP_REFERER'], 'buildpro');

        
        // $cssFile = scandir(plugins_url('/frontend/build/static/css/'));
        // if(is_dir(plugins_url('lc-socios/frontend/build/static/css/'))) {
        //   $archivos = scandir(plugins_url('/frontend/build/static/css/'));
        //   // ...
        // } else {
        //     echo "El directorio no existe o no se tiene permisos para acceder a él";
        // }

        // foreach($cssFile as $archivo) {
        //     if (!is_dir($archivo)) {
        //         echo $archivo . "<br>";
        //     }
        // }


        if($_GET['buildpro'] || (($_SERVER['SERVER_NAME'] === 'aesiguenza.es' && $_SERVER['REQUEST_URI'] === '/website/socios/' && $_SERVER['REQUEST_URI'] === '/socios/'))) {
          wp_register_style('lcLoadSociosModuleStyle', esc_url(plugins_url('/frontend/build/static/css/main.c83fb7d0.css', dirname(__FILE__) )), true);
          wp_register_script('lcLoadSociosModule', esc_url(plugins_url('/frontend/build/static/js/main.f659b0a4.js', dirname(__FILE__) )), true);
          wp_register_script('lcLoadSociosModule', esc_url(plugins_url('/frontend/build/static/js/787.2ede73bf.chunk.js', dirname(__FILE__) )), true);
        }else{
          wp_register_script('lcLoadSociosModule', 'http://localhost:3000/static/js/bundle.js', true);
        }
        wp_localize_script('lcLoadSociosModule', 'wp_pageviews_ajax', array(
          'ajax_url' => admin_url('admin-ajax.php'),
          'nonce' => wp_create_nonce( 'wp-pageviews-nonce' ),
          'terminosSector' => $terminosSector,
          'terminosActidad' => $terminosActividad,
          'terminosTipoSocios' => $terminosTipoSocio,
        ));
        wp_enqueue_script('lcLoadSociosModule');
        wp_enqueue_style('lcLoadSociosModuleStyle');
        return $output;
      }
      add_shortcode('lc-socios-module', 'lcLoadScriptModule');
    }

   
}

