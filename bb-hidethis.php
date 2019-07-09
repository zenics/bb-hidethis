<?php

/**
 * Plugin Name: Beaver Builder HideThis
 * Plugin URI: http://www.creativemanner.com
 * Description: A Beaver Builder plugin that allows you to hide a module, row or column if a set post module doesnt have any post.
 * Version: 1.1
 * Author: Oz Coruhlu
 * Author URI: https://www.linkedin.com/in/ocoruhlu
 */


if(! class_exists ( 'CM_HideThis'))
{

  class CM_HideThis{

    function __construct(){

      //filters
      add_filter( 'fl_builder_register_settings_form' , array($this,'add_hideThis_settings'), 20 , 2 );
      add_filter('fl_builder_module_attributes', array($this,'add_hider_attributes'),  10, 2);
      add_filter( 'fl_builder_render_js' ,  array( $this,'hideThis_js'), 10, 2);
      
    }

    
    function add_hideThis_settings( $form, $id ) {

      if ( 'module_advanced' === $id ) {
      
     $form[ 'sections' ][ 'visibility' ][ 'fields' ][ 'hider' ] = [
          'type'    => 'select',
          'label'   => 'Hide Something',
          'default' => 'false',
          'options'       => array(
            'false'      => __( 'No', 'fl-builder' ),
            'true'      => __( 'Yes', 'fl-builder' )
          ),
          'toggle'        => array(
            'true'      => array(
                'fields'  => array( 'wrapnode' )
             ),
            'false'   => array()
          )
        ];

          $form[ 'sections' ][ 'visibility' ][ 'fields' ][ 'wrapnode' ] = [
          'type'        => 'text',
          'label'       => 'Wrapping Node id',
          'description' => 'Node id of the Wrapping row or column',
          'default'     => '',
        ];
        
      }


      /**
       * Now we pass back the form to the filter
       */
      return $form;
    }
    function add_hider_attributes( $attrs, $module ) {
      // if there is a data sticky attribute set, then add the atts to the page
      if ( $module->settings->wrapnode !== ''  && 'true' == $module->settings->hider) {
        $attrs[ 'data-hider' ] = $module->settings->hider;
        $attrs[ 'data-hiderwrapper' ] = $module->settings->wrapnode;
      }
      return $attrs;
    }


/**
 * Renders JS 
 */
function hideThis_js( $js ){

 ob_start();

 include 'includes/frontend.js.php';
 return $js .= ob_get_clean();

}


  
}
  $cmrun = new CM_HideThis();
}