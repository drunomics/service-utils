<?php

namespace drunomics\ServiceUtils\Symfony\HttpFoundation;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Allows setter injection and simple usage of the service.
 */
trait RequestStackTrait {

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Sets the request stack object to use.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack object.
   *
   * @return $this
   */
  public function setRequestStack(RequestStack $request_stack) {
    $this->requestStack = $request_stack;
    return $this;
  }

  /**
   * Gets the request stack.
   *
   * @return \Symfony\Component\HttpFoundation\RequestStack
   *   The request stack.
   */
  protected function getRequestStack() {
    if (!$this->requestStack) {
      $this->requestStack = \Drupal::service('request_stack');
    }
    return $this->requestStack;
  }

  /**
   * Gets the current request.
   *
   * @return \Symfony\Component\HttpFoundation\Request
   *   The request object.
   */
  protected function getCurrentRequest() {
    return $this->getRequestStack()->getCurrentRequest();
  }

}
