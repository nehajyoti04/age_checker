<?php

namespace Drupal\age_checker\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

//use Drupal\Core\Routing\RouteMatchInterface;
//use \Drupal\Core\Form\FormStateInterface;
//use Drupal\Core\State\State;
//
//use Drupal\Core\DrupalKernel;
//use Drupal\Core\Form\EnforcedResponseException;
//use Drupal\Core\Url;
//use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Drupal\Core\Site\Settings;
//use Drupal\Core\Render\RendererInterface;
//use Drupal\Core\Routing\UrlGeneratorInterface;
//use Drupal\Core\Session\AccountInterface;
//use Symfony\Component\EventDispatcher\EventSubscriberInterface;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
//use Symfony\Component\HttpKernel\KernelEvents;


class AgeCheckerAgeGate extends ControllerBase {

  /**
   * Function age_checker_template.
   */
  public function age_checker_template() {

    // Getting the language Code.
    $language_code = $this->age_checker_get_language_code();

//    dpm("language code");
//    dpm($language_code);
    // Header text of the form.
    $age_checker_header_message_array = \Drupal::state()
      ->get('age_checker_' . $language_code . '_age_gate_header');
    $age_checker_header_message = $age_checker_header_message_array['value'];

    // Form Element.

    $age_checker_form = \Drupal::formBuilder()->getForm('\Drupal\age_checker\Form\AgeCheckerForm');
//    $age_checker_form = \Drupal::formBuilder()->getForm('age_checker_form');
//    dpm($age_checker_form);
//    exit;
    // Footer text of the form.
    $age_checker_footer_message_array = \Drupal::state()->get('age_checker_' . $language_code . '_age_gate_footer');
    $age_checker_footer_message = $age_checker_footer_message_array['value'];

//    dpm("header");
//    dpm($age_checker_header_message);
//    dpm("footer");
//    dpm($age_checker_footer_message);
//    exit;

//    return theme('age_checker',
//      array(
//        'age_checker_header_message' => $age_checker_header_message,
//        'age_checker_form' => $age_checker_form,
//        'age_checker_footer_message' => $age_checker_footer_message,
//      )
//    );

//    $loader = [
//      '#theme' => 'webprofiler_loader',
//      '#token' => $token,
//      '#profiler_url' => $this->urlGenerator->generate('webprofiler.toolbar', ['profile' => $token]),
//    ];
//
//    $loader = [
//      '#theme' => 'age_checker',
//      '#token' => $token,
//      '#profiler_url' => $this->urlGenerator->generate('webprofiler.toolbar', ['profile' => $token]),
//    ];

//    return array(
//      '#theme' => 'age_checker',
////      '#test_var' => $this->t('Test Value'),
//    );


    return array(
      '#theme' => 'age_checker',
      '#age_checker_header_message' => $age_checker_header_message,
      '#age_checker_form' => $age_checker_form,
      '#age_checker_footer_message' => $age_checker_footer_message,
    );


//    return array(
//      '#theme' => 'age_checker',
//      '#age_checker_header_message' => $age_checker_header_message,
//    );


//    exit;


//    return theme('age_checker',
//      array(
//        'age_checker_header_message' => $age_checker_header_message,
//        'age_checker_footer_message' => $age_checker_footer_message,
//      )
//    );


//    // Sending variable to template.
//    return theme('age_checker',
//      array(
//        'age_checker_header_message' => $age_checker_header_message,
//        'age_checker_form' => $age_checker_form,
//        'age_checker_footer_message' => $age_checker_footer_message,
//      )
//    );
//    return TRUE;
  }


  /**
   * Getting the language_code on the basis of Country selected.
   */
  public function age_checker_get_language_code() {

    $languages_options = array();
    $countries_array = array();
    $languages = \Drupal::state()->get('age_checker_language', '');
    $languages = explode("\n", $languages);

    foreach ($languages as $language) {
      $language = explode('|', $language);
      $language = array_map('trim', $language);

      $languages_options[$language[0]] = isset($language[1]) ? $language[1] : NULL;
    }

//    dpm("function call");
//    dpm(age_checker_get_country_name());
    $selected_country = isset($_COOKIE['country_selected']) ? $_COOKIE['country_selected'] : age_checker_get_country_name();

    foreach ($languages_options as $key => $value) {

      $countries_array = \Drupal::state()->get('age_checker_' . $key . '_country_list');

      foreach ($countries_array as $country) {
        if ($country == $selected_country) {
          return $key;
        }
      }
    }
//    return "hello";
  }


}
