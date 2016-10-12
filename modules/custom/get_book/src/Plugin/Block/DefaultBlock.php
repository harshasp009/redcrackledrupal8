<?php

/**
 * @file
 * Contains Drupal\new_block\Plugin\Block\DefaultBlock.
 */

namespace Drupal\get_book\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DefaultBlock' block.
 *
 * @Block(
 *  id = "default_block",
 *  admin_label = @Translation("Default block"),
 * )
 */
class DefaultBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['e_mail'] = array(
      '#type' => 'email',
      '#title' => $this->t('E-Mail'),
      '#description' => $this->t('E-Mail field'),
      '#default_value' => isset($this->configuration['e_mail']) ? $this->configuration['e_mail'] : '',
    );
    $form['company'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Company'),
      '#description' => $this->t(''),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $email = $form_state->getValue('e_mail');
    $company = $form_state->getValue('company');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'my_block';
//    $build['default_block_e_mail']['#markup'] = '<p>' . $this->configuration['e_mail'] . '</p>';
//    $build['default_block_password']['#markup'] = '<p>' . $this->configuration['password'] . '</p>';

    $form  = \Drupal::formBuilder()->getForm('Drupal\get_book\Form\DefaultForm');

    $build['form'] = $form;

    return $build;
  }

}
