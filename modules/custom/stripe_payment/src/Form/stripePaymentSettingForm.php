<?php

namespace Drupal\stripe_payment\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure stripe payment settings.
 */
class stripePaymentSettingForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'stripe_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'stripe_payment.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('stripe_payment.settings');

    $form['stripe_api_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Stripe API Key'),
      '#default_value' => $config->get('stripe_api_key') ,
    );

    $form['stripe_publish_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Stripe Publish Key'),
      '#default_value' => $config->get('stripe_publish_key') ,
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('stripe_payment.settings');
    $config->set('stripe_api_key', $form_state->getValue('stripe_api_key'))
      ->set('stripe_publish_key', $form_state->getValue('stripe_publish_key'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}