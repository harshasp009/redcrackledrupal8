<?php

namespace Drupal\stripe_payment\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
//use \Stripe\stripe;
//use \Stripe\Charge;
//use \Stripe\Customer;
class stripePaymentForm extends FormBase {

  /**
   * Machine name of the form
   */
  const FORM_ID = 'stripe_payment';
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return self::FORM_ID;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['full_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#description' => $this->t('Please Enter your Full Name'),

    );

    $form['e_mail'] = array(
      '#type' => 'email',
      '#title' => $this->t('E-Mail'),
      '#description' => $this->t('Please Enter a valid Email'),
    );

    $form['phone_numeber'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#description' => $this->t('Please enter your telephone number'),
    );

    $form['company'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Company'),
      '#description' => $this->t('Please enter your Company'),
    );

    $form['company'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Company'),
      '#description' => $this->t('Please enter your Company'),
    );

    $form['number'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Card Number'),
      '#maxlength' => 16,
      '#description' => $this->t('Please enter your valid 16 digit card number'),
      '#attributes' => array(
        'data-stripe' => 'number',
        'autocomplete' => 'off',
        'placeholder' => 'CARD NUMBER'
      ),
      '#required' => TRUE,
    );

    $form['cvc'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('cvc number'),
      '#maxlength' => 16,
      '#description' => $this->t('Please enter your valid 3 digit cvc number at the backside of your card'),
      '#attributes' => array(
        'data-stripe' => 'cvc',
        'autocomplete' => 'off',
        'placeholder' => 'CVC'
      ),
      '#required' => TRUE,
    );


    $form['exp_month'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Expiry Month'),
      '#maxlength' => 2,
      '#size' => 2,
      '#description' => $this->t('Please enter your expiry month'),
      '#attributes' => array(
        'data-stripe' => 'exp_month',
        'autocomplete' => 'off',
        'placeholder' => 'MM'
      ),
      '#required' => TRUE,
    );

    $form['exp_year'] = array(
      '#type' => 'textfield',
      '#maxlength' => 4,
      '#size' => 4,
      '#description' => $this->t('Please enter your expiry year'),
      '#attributes' => array(
        'data-stripe' => 'exp_year',
        'autocomplete' => 'off',
        'placeholder' => 'YYYY'
      ),
      '#required' => TRUE,
    );


    $form['stripeToken'] = array(
      '#type' => 'hidden',
      '#attributes' => array(
        'id' => 'stripeToken'
      ),
    );

    $form['pay_plan'] = array(
      '#type' => 'hidden',
      '#attributes' => array(
        'id' => 'pay_plan',
      ),
      '#default_value' => $_GET['plan'],
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Pay'),
      '#button_type' => 'primary',
    );


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $full_name = $form_state->getValue('full_name');
    $e_mail = $form_state->getValue('e_mail');
    $phone_numeber = $form_state->getValue('phone_numeber');
    $company = $form_state->getValue('company');
    $number = $form_state->getValue('number');
    $cvc = $form_state->getValue('cvc');
    $exp_month = $form_state->getValue('exp_month');
    $exp_year = $form_state->getValue('exp_year');
    $stripeToken = $form_state->getValue('stripeToken');
    $pay_plan = $form_state->getValue('pay_plan');


    $stripe_api_key = \Drupal::config('stripe_payment.settings')->get('stripe_api_key');
    $stripe_publish_key = \Drupal::config('stripe_publish_key.settings')->get('stripe_publish_key');
    define('SECRET_KEY', $stripe_api_key );
    define('PUBLISHABLE_KEY', $stripe_publish_key );
//    Stripe::setApiKey('sk_test_n3rFohTOjpOWQC87JErk4pjB');
//    $customer = Customer::create(array(
//        "source" => $stripeToken,
//        'email' => $e_mail,
//        'plan' => $pay_plan,
//        "description" => "Example customer")
//    );
//    try {
//      $charge = Charge::create(array(
//        "amount" => 1000, // Amount in cents
//        "currency" => "usd",
//        "source" => $stripeToken,
//        "description" => "Example charge"
//      ));
//    } catch(\Stripe\Error\Card $e) {
//      // The card has been declined
//    }

  }
}