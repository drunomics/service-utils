<?php

namespace drunomics\ServiceUtils\Core\State;

use Drupal\Core\State\StateInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait StateTrait {

  /**
   * The state storage.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * Sets the current user.
   *
   * @param \Drupal\Core\State\StateInterface $state
   *   The state storage.
   *
   * @return $this
   */
  public function setState(StateInterface $state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets the state storage.
   *
   * @return \Drupal\Core\State\StateInterface
   *   The state storage.
   */
  public function getState() {
    if (empty($this->state)) {
      $this->state = \Drupal::service('state');
    }
    return $this->state;
  }

}
