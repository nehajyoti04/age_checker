<?php
// file shoud be in /mymodule/src/MyModuleSubscriber.php
/**
* @file
* Contains \Drupal\mymodule\MyModuleSubscriber.
*/

namespace Drupal\age_checker\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

/**
* Provides a MyModuleSubscriber.
*/
class AgeCheckerSubscriber implements EventSubscriberInterface {

/**
* // only if KernelEvents::REQUEST !!!
* @see Symfony\Component\HttpKernel\KernelEvents for details
*
* @param Symfony\Component\HttpKernel\Event\GetResponseEvent $event
*   The Event to process.
*/
public function AgeCheckerSubscriberLoad(GetResponseEvent $event) {
// @todo remove this debug code
  // Specify relative path to the drupal root.
  $user = \Drupal::currentUser();
//  global $base_url;
//
//  $path = current_path();
//  $destination = ($path == 'agegate') ? $_GET['destination'] : $path;
//
  $age_gate_cookie = isset($_COOKIE['age_checker']) ? $_COOKIE['age_checker'] : 0;
  $remember_me_cookie = isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : 0;

  if ($user->id() > 0) {
    setcookie('age_checker', 1, 0, $GLOBALS['base_path'], NULL, FALSE, TRUE);
  }

  if (($age_gate_cookie != 1) && ($remember_me_cookie != 1)) {
    if ($this->age_checker_show_age_gate()) {

    }

  }
  drupal_set_message('AgeCheckerSubscriber: subscribed');
}


/**
* {@inheritdoc}
*/
static function getSubscribedEvents() {
$events[KernelEvents::REQUEST][] = array('AgeCheckerSubscriberLoad', 20);
return $events;
}

  /**
   * Function to control age checker display depending user and accesses.
   *
   * @return bool
   *   True if must be shown
   */
  public function age_checker_show_age_gate() {
    // User Access.
//    if ((!user_access('administrator')) && ($this->age_checker_visibility() == 1)) {
//      return TRUE;
//    }

    if (($this->age_checker_visibility() == 1)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Calculate visibility of age checker if set.
   *
   * Function copy from block.module, thanks for the original code.
   *
   * return boolean
   */
  public function age_checker_visibility() {

//    $visibility = variable_get('age_checker_visibility', AGE_CHECKER_VISIBILITY_NOTLISTED);
//    $pages = variable_get('age_checker_pages');
//
//    // Convert path to lowercase.
//    $pages = drupal_strtolower($pages);
//    if ($visibility < 2) {
//      // Convert the Drupal path to lowercase.
//      $path = drupal_strtolower(drupal_get_path_alias(current_path()));
//      // Compare the lowercase internal and lowercase path alias (if any).
//      $page_match = drupal_match_path($path, $pages);
//
//      if ($path != current_path()) {
//        $page_match = $page_match || drupal_match_path(current_path(), $pages);
//      }
//
//      $page_match = !($visibility xor $page_match);
//    }
//    elseif (module_exists('php')) {
//      $page_match = php_eval($pages);
//    }
//    else {
//      $page_match = FALSE;
//    }
//    return $page_match;
  }

}