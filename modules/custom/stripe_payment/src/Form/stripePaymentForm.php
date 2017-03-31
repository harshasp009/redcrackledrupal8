<?php

namespace Drupal\stripe_payment\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use \Drupal\node\Entity\Node;

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
      '#attributes' => array(
        'class' => 'submit',
      ),
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
    if($pay_plan == 'std') {
      $plan = "standard";
    } elseif($pay_plan == 'prof'){
      $plan = "professional";
    } elseif($pay_plan == 'vip'){
      $plan = "vip";
    }
    $stripe_api_key = \Drupal::config('stripe_payment.settings')->get('stripe_api_key');
    $stripe_publish_key = \Drupal::config('stripe_publish_key.settings')->get('stripe_publish_key');
    define('SECRET_KEY', $stripe_api_key );
    define('PUBLISHABLE_KEY', $stripe_publish_key );
    $vendor_path =  drupal_get_path('module','stripe_payment')."/vendor/autoload.php";
    require_once($vendor_path);
    $current_date = date('Y-m-d');
    $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($current_date)));
    $trial_date = strtotime($effectiveDate);
    try {
      \Stripe\Stripe::setApiKey(SECRET_KEY);
      $customer = \Stripe\Customer::create(array(
          "source" => $stripeToken,
          'email' => $e_mail,
          'plan' => $plan,
          "description" => "new customer",
        )
      );
      $node = Node::create([
        'type'        => 'customer_details',
        'title'       => $full_name,
        'field_email_id' => $e_mail,
        'field_company' => $company,
        'field_phone_number' => $phone_numeber,
        'field_plan' => $plan,
        'field_sign_up_date' => $current_date,
      ]);
      $node->save();
      $responses = $this->_send_mails($e_mail, $full_name,$plan);
      if($responses['send']) {
        drupal_set_message('Thank You for signing up. we will contact you.');
      } else {
        drupal_set_message('Please contact administrator for details');
      }
    }
    catch (Exception $e) {
      //form_set_error('', $e->getMessage());
      $form_state->setRebuild();
      return;
    }

  }

  public function _send_mails($e_mail, $full_name,$plan) {
    $key = 'stripe_mail';
    $to = $e_mail;
    $text = "Thank You for signup for the plan ".$plan.". We will contact you as soon as possible.";
    $params['message'] = $text ;
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $result = \Drupal::service('plugin.manager.mail')->mail('stripe_payment', $key, $to, $langcode, $params, NULL, $send);
    return $result;
  }
}