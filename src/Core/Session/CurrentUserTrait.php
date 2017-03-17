<?php

namespace drunomics\ServiceUtils\Core\Session;

use Drupal\Core\Session\AccountProxyInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait CurrentUserTrait {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Sets the current user.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   *   The current user.
   *
   * @return $this
   */
  public function setCurrentUser(AccountProxyInterface $currentUser) {
    $this->currentUser = $currentUser;
    return $this;
  }

  /**
   * Gets the current user.
   *
   * @return \Drupal\Core\Session\AccountProxyInterface
   *   The current user.
   */
  public function getCurrentUser() {
    if (empty($this->currentUser)) {
      $this->currentUser = \Drupal::service('current_user');
    }
    return $this->currentUser;
  }

}
