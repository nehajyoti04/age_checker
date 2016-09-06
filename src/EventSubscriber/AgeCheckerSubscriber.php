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
drupal_set_message('AgeCheckerSubscriber: subscribed');
}

/**
* {@inheritdoc}
*/
static function getSubscribedEvents() {
$events[KernelEvents::REQUEST][] = array('AgeCheckerSubscriberLoad', 20);
return $events;
}
}