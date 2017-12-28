<?php

namespace Drupal\custom_convert_to_relative\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a filter to convert absolute to relative.
 *
 * @Filter(
 *   id = "filter_relative",
 *   title = @Translation("Relative Filter"),
 *   description = @Translation("Help this text convert absolute to relative"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_IRREVERSIBLE,
 * )
 */

class FilterRelative extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $siteurl = \Drupal::request()->getSchemeAndHttpHost();
    \Drupal::logger('custom_convert_to_relative')->notice($siteurl);
    $replace = '';
    $new_text = str_replace($siteurl, $replace, $text);
    $result = new FilterProcessResult($new_text);
    return $result;
  }
}