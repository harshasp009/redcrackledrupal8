<?php

namespace Drupal\less_preprocessor\Controller;

use Drupal\Core\Controller\ControllerBase;

class LessPreprocessController extends ControllerBase {

 public function get_config_values() {

   $config = \Drupal::config('less_preprocessor.settings');
   $input_file_path = $config->get('input_file');
   $destination_file_path = $config->get('source_file');
   // pass the variable

   if(!empty($input_file_path) && (!empty($destination_file_path))) {
    $less_gen =  _less_preprocessor_generate_css($input_file_path,$destination_file_path);
   }
   else {
     $less_gen = "not generated";
   }
   return $less_gen;
 }
}