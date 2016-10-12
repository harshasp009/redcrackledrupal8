<?php

namespace Drupal\related_post\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Related Blog Post
 *
 * @Block(
 *   id = "related_blog_post",
 *   admin_label = @Translation("Related Blog Post"),
 *   category = @Translation("Custom Related Blog Post block")
 * )
 */
class RelatedBlogPost extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $get_val = _get_entity();
    return array(
      '#type' => 'markup',
      '#markup' => $get_val ,
    );
  }


}