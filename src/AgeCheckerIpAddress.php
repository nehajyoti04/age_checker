<?php

namespace Drupal\age_checker;

use Symfony\Component\HttpFoundation\Request;

class AgeCheckerIpAddress {
/**
* @var \Symfony\Component\HttpFoundation\Request
*/
protected $request;

/**
* Constructs a Foo object.
*
* @param Symfony\Component\HttpFoundation\Request $request
*   The request object.
*/
public function __construct(Request $request) {
$this->request = $request;
}

public function bar() {
if ($ip == $this->request->getClientIp()) {
drupal_set_message('ip', t('You may not ban your own IP address.'));
}
}

}