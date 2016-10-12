<?php

namespace Drupal\mauticintegration\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;



/**
 * Provides a 'Mautic Form' Block
 *
 * @Block(
 *   id = "Mautic_form",
 *   admin_label = @Translation("Mautic Form Block"),
 * )
 */
class MauticFormBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $form_id = $config['mautic_form_id'];
    $data = \Drupal::state()->get('mautic_base_url');
//     $content = '<div class="mauticform_wrapper" id="mauticform_wrapper_objectorientedphpfordrupaldevelopers">';
//    $content .= '<form action="http://offers.redcrackle.com/form/submit?formId=5" autocomplete="false" data-mautic-form="objectorientedphpfordrupaldevelopers" id="mauticform_objectorientedphpfordrupaldevelopers" method="post" role="form">';
//    $content .= '<div class="mauticform-error" id="mauticform_objectorientedphpfordrupaldevelopers_error">&nbsp;</div>
//                 <div class="mauticform-message" id="mauticform_objectorientedphpfordrupaldevelopers_message" style="margin-bottom:20px; color: red;font-size:1.4em; line-height: 1.4em;">&nbsp;</div>';
//    $content .= '<div class="mauticform-innerform">
//                 <div class="mauticform-row mauticform-email mauticform-required" id="mauticform_objectorientedphpfordrupaldevelopers_email"><label class="mauticform-label" for="mauticform_input_objectorientedphpfordrupaldevelopers_email" id="mauticform_label_objectorientedphpfordrupaldevelopers_email">Email</label> <input class="mauticform-input" id="mauticform_input_objectorientedphpfordrupaldevelopers_email" name="mauticform[email]" placeholder="Email address" type="email" value="" /> <span class="mauticform-errormsg" style="display: none;">Company email is required.</span></div>
//                 <div class="mauticform-row mauticform-text mauticform-required" id="mauticform_objectorientedphpfordrupaldevelopers_company"><label class="mauticform-label" for="mauticform_input_objectorientedphpfordrupaldevelopers_company" id="mauticform_label_objectorientedphpfordrupaldevelopers_company">Company</label> <input class="mauticform-input" id="mauticform_input_objectorientedphpfordrupaldevelopers_company" name="mauticform[company]" placeholder="Name of your company" type="text" value="" /> <span class="mauticform-errormsg" style="display: none;">Company name is required</span></div>
//                 <div class="mauticform-row mauticform-button-wrapper" id="mauticform_objectorientedphpfordrupaldevelopers_submit"><button class="mauticform-button" id="mauticform_input_objectorientedphpfordrupaldevelopers_submit" name="mauticform[submit]" type="submit" value="">I want to learn object-oriented PHP</button></div><input id="mauticform_objectorientedphpfordrupaldevelopers_id" name="mauticform[formId]" type="hidden" value="5" /> <input id="mauticform_objectorientedphpfordrupaldevelopers_return" name="mauticform[return]" type="hidden" value="" /> <input id="mauticform_objectorientedphpfordrupaldevelopers_name" name="mauticform[formName]" type="hidden" value="objectorientedphpfordrupaldevelopers" /></div></form></div>';
    $build['mautic_form_block']  = [
      '#theme' => 'automatic_form',
      '#base_url' => $data,
      '#form_id' => $form_id
    ];
    return $build;
//    return array(
//      '#type' => 'markup',
//      '#markup' => $content,
//    );
  }
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['mautic_form_id'] = array (
      '#type' => 'textfield',
      '#title' => $this->t('Mautic form ID'),
      '#description' => $this->t('Enter Mautic Form ID'),
      '#default_value' => isset($config['mautic_form_id']) ? $config['mautic_form_id'] : '',
    );

    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('mautic_form_id', $form_state->getValue('mautic_form_id'));
  }
}