<?php

namespace Drupal\custom_convert_to_relative\Controller;

use Drupal\Core\Controller\ControllerBase;

class RelativeController extends ControllerBase {

   public function remove_absolute_link() {
     $config = \Drupal::config ('custom_convert_to_relative.settings');
     $remove_link = $config->get ('remove_base_url');

   }
}