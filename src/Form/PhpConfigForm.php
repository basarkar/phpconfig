<?php
/**
 * Created by PhpStorm.
 * User: bappasarkar
 * Date: 4/21/17
 * Time: 2:23 PM
 */
/**
 * @file
 * Contains \Drupal\phpconfig\Form\PhpConfigForm.
 */
namespace Drupal\phpconfig\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class PhpConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'phpconfig_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $configid=NULL) {
    $edit_flag = FALSE;
    if (isset($configid)) {
      $config_object = phpconfig_get_config($configid);
      if (empty($config_object)) {
        drupal_set_message(t('The configuration id !id is not valid', array('!id' => $configid)));
        return;
      }
      else {
        $edit_flag = TRUE;
        //$form_state['op_type'] = "update";
        //$form_state['configid'] = $config_object->configid;
      }
    }
    $form['phpconfig'] = array(
      '#type' => 'fieldset',
      '#title' => t('PHP Config'),
    );
    $form['phpconfig']['item'] = array(
      '#type' => 'textfield',
      '#title' => t('Item'),
      '#description' => t('Type PHP configuration item. E.g. memory_limit'),
      '#default_value' => ($edit_flag) ? $config_object->item : '',
      '#required' => TRUE,
    );
    $form['phpconfig']['value'] = array(
      '#type' => 'textfield',
      '#title' => t('Value'),
      '#description' => t('Type value of the above configuration item.'),
      '#default_value' => ($edit_flag) ? $config_object->value : '',
      '#required' => TRUE,
    );
    if ($edit_flag) {
      $form['phpconfig']['status'] = array(
        '#type' => 'checkbox',
        '#title' => t('Enabled'),
        '#default_value' => $config_object->status,
      );
    }
    $form['phpconfig']['actions']['#type'] = 'actions';
    $form['phpconfig']['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save'),
      '#button_type' => 'primary',
    );
    if ($edit_flag) {
      $form['phpconfig']['actions']['delete'] = array(
        '#type' => 'submit',
        '#value' => t('Delete'),
      );
    }
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('candidate_number')) < 10) {
      $form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
    }
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
  }
}