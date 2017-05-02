<?php

namespace Drupal\custom_convert_to_relative\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\custom_convert_to_relative\Controller\RelativeController;

class ConvertRelative extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_convert_to_relative_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    // Name config file.
    return ['custom_convert_to_relative.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_convert_to_relative.settings');


    $form['remove_base_url'] = array(
     '#type' => 'textfield',
     '#title' => $this->t('Remove base url'),
     '#description' => $this->t('Enter the base url to remove with http/https'),
     '#default_value' => $config->get('remove_base_url'),
    );

    $form['run_batch'] = array(
     '#type' => 'details',
     '#title' => t('Remove absolute links'),
     '#open' => TRUE,
    );
    $form['run_batch']['remove_link'] = array(
     '#type' => 'submit',
     '#value' => t('Run BatcH'),
     '#submit' => array('::submitRunBatch'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('custom_convert_to_relative.settings')
     ->set('remove_base_url', $values['remove_base_url'])
     ->save();
  }


}