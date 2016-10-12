<?php

namespace Drupal\less_preprocessor\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\less_preprocessor\Controller\LessPreprocessController;

class LessPreprocessorForm extends ConfigFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'less_preprocessor_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    // Name config file.
    return ['less_preprocessor.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('less_preprocessor.settings');


    $form['input_file'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Source File'),
      '#description' => $this->t('Enter the input file name'),
      '#default_value' => $config->get('input_file'),
    );
    $form['source_file'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Destination File'),
      '#description' => $this->t('Enter the input file name'),
      '#default_value' => $config->get('source_file'),
    );
    $form['flush_less'] = array(
      '#type' => 'details',
      '#title' => t('Rebuild Less Files'),
      '#open' => TRUE,
    );
    $form['flush_less']['clear_less'] = array(
      '#type' => 'submit',
      '#value' => t('Flush LESS'),
      '#submit' => array('::submitFlushLess'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('less_preprocessor.settings')
      ->set('input_file', $values['input_file'])
      ->set('source_file', $values['source_file'])
      ->save();
    drupal_set_message($this->t('Configuration has been saved successfully'));
  }

  public function submitFlushLess(array &$form, FormStateInterface $form_state) {
    $value = new LessPreprocessController();
    $val1 = $value->get_config_values();
    drupal_set_message($this->t('file path @file_path',array('@file_path' => $val1)));

  }
}