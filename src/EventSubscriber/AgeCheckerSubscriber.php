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
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Form\FormBase;
use Drupal\ban\BanIpManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Component\Utility\Unicode;
/**
* Provides a MyModuleSubscriber.
*/
class AgeCheckerSubscriber implements EventSubscriberInterface {


//  protected $request;

//  public static function create(ContainerInterface $container) {
//    return new static(
//      $container->get('age_checker.subscriber')
//    );
//  }

  /**
   * Constructs a Foo object.
   *
   * @param Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   */
//  public function __construct(Request $request) {
//    $this->request = $request;
//  }

//  public function _get_ip_address() {
//    return $this->getRequest()->getClientIP();
////    return $this->request->getClientIp();
////    if ($ip == $this->request->getClientIp()) {
////      drupal_set_message('ip', t('You may not ban your own IP address.'));
////    }
//  }

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
    dpm("cookie set");
  }
  // else {
  //   dpm("cookie not set");
  // }

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
  public static function age_checker_show_age_gate() {
    // User Access.
//    if ((!user_access('administrator')) && ($this->age_checker_visibility() == 1)) {
//      return TRUE;
//    }
// dpm("hello");
// dpm($this->age_checker_visibility());
 // \Drupal::logger('pagees')->notice("inside function"); exit;

   $visibility = \Drupal::state()->get('age_checker_visibility', AGE_CHECKER_VISIBILITY_NOTLISTED);
   $pages = \Drupal::state()->get('age_checker_pages');
   $current_path = \Drupal::service('path.current')->getPath();

   // Convert path to lowercase.
   $pages = Unicode::strtolower($pages);
   // \Drupal::logger('pagees')->notice($pages);
   if ($visibility < 2) {
     // Convert the Drupal path to lowercase.
     $path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($current_path);
     $path = Unicode::strtolower($path_alias);
     // Compare the lowercase internal and lowercase path alias (if any).
     $page_match = \Drupal::service('path.matcher')->matchPath($path, $pages);

     if ($path != $current_path) {
       $page_match = $page_match || \Drupal::service('path.matcher')->matchPath($current_path, $pages);
     }

     $page_match = !($visibility xor $page_match);
   }
   elseif (\Drupal::moduleHandler()->moduleExists('php')) {
     $page_match = php_eval($pages);
   }
   else {
     $page_match = FALSE;
   }
   // \Drupal::logger('pagee match')->notice($page_match); exit;
   // return $page_match;
$age_checker_visibility = $page_match;
// \Drupal::logger('age checker property')->notice($this->age_checker_visibility()); exit;
    if ($age_checker_visibility == 1) {
      return TRUE;
    }
    return FALSE;
  }



}
