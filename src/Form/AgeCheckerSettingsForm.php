<?php

/**
 * @file
 * Contains \Drupal\age_calculator\Form\AgeCalculatorSettingsForm.
 */

namespace Drupal\age_checker\Form;

use Drupal\Core\Datetime\Date;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class AgeCheckerSettingsForm extends ConfigFormBase {
  public function getFormId() {
    return 'age_checker_settings';
  }
  public function getEditableConfigNames() {
    return [
      'age_checker.settings',
    ];

  }
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('age_checker.settings');


    return parent::buildForm($form, $form_state);
  }


  /**
   * Implements hook_form_submit().
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set values in variables.
//    $this->config('age_calculator.settings')
//      ->set('age_calculator_output', $form_state->getValues()['age_calculator_output'])
//      ->save();
    parent::submitForm($form, $form_state);
  }
}

