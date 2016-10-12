<?php
/**
 * Created by PhpStorm.
 * User: ey
 * Date: 01/10/15
 * Time: 18:11
 */

namespace Drupal\get_book\Form;

use Drupal\file\Entity\File;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class DefaultForm extends FormBase {

  /**
   * Machine name of the form
   */
  const FORM_ID = 'default_form';
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
    $form['e_mail'] = array(
      '#type' => 'email',
      '#title' => $this->t('E-Mail'),
      '#description' => $this->t('Please Enter a valid Email'),
      '#default_value' => isset($this->configuration['e_mail']) ? $this->configuration['e_mail'] : '',
    );
    $form['company'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Company'),
      '#description' => $this->t('Please enter your Company'),
      '#suffix' => '<span class="email-valid-message"></span>'
    );
    $form['actions']['#action'] = '/test/blog';
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Get eBook'),
      '#button_type' => 'primary',
      '#submit' => array('::submitForm'),
    );


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $file_attachment = drupal_get_path('module','new_block')."/docs/object-oriented-php-for-drupal-developers.pdf";
    $email = $form_state->getValue('e_mail');
    $company = $form_state->getValue('company');
    //\Drupal::logger('new_block')->error($email);
    $responses = $this->_send_mail($email, $file_attachment);
    if($responses['send']){
      drupal_set_message('Success! You should receive an email with a link.');
    } else {
      drupal_set_message('Email Not sent. Please contact Administartor');
    }


  }

  public function _send_mail($email, $file_attachment) {
    //$mailManager = \Drupal::service('plugin.manager.mail');
    $file_content = file_get_contents($file_attachment);
    $attachments = array(
      'filecontent' => $file_content,
      'filename' => 'object-oriented-php-for-drupal-developers.pdf',
      'filemime' => 'application/pdf',
      'filepath' => file_create_url($file_attachment),
    );

    $key = 'test';
    $to = $email;
    $params['attachment'] = $attachments; ;
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $result = \Drupal::service('plugin.manager.mail')->mail('new_block', $key, $to, $langcode, $params, NULL, $send);
   return $result;

  }



}