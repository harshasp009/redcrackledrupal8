<?php
/**
 * @file
 * Contains \Drupal\mauticintegration\Form\MauticSettingForm
 */
namespace Drupal\mauticintegration\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure mautic settings for this site.
 */
class MauticSettingForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mautic_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'mauticintegration.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mauticintegration.settings');

    $form['mautic_base_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Mautic URL'),
      '#default_value' => $config->get('mautic_base_url') ,
    );

//    $form['mautic_load_form_js'] = array(
//      '#type' => 'checkbox',
//      '#title' => $this->t('Use Mautic Forms'),
//      '#default_value' => $config->get('mautic_load_form_js'),
//    );


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('mauticintegration.settings');
    $config->set('mautic_base_url', $form_state->getValue('mautic_base_url'))
      ->save();
//    $values = $form_state->getValues();
//    $this->config('mauticintegration.settings')
//      ->set('mautic_base_url', $values['mautic_base_url'])
//      ->save();

    parent::submitForm($form, $form_state);
  }
}