<?php

namespace drunomics\ServiceUtils\user;

use Drupal\user\SharedTempStoreFactory;

/**
 * Allows setter injection and simple usage of the service.
 */
trait SharedTempStoreFactoryTrait {

  /**
   * Shared tempstore factory.
   *
   * @var \Drupal\user\SharedTempStoreFactory
   */
  protected $sharedTempStoreFactory;

  /**
   * Sets shared tempstore factory.
   *
   * @param \Drupal\user\SharedTempStoreFactory $file_usage
   *   Shared tempstore factory.
   *
   * @return $this
   */
  public function setSharedTempStoreFactory(SharedTempStoreFactory $file_usage) {
    $this->sharedTempStoreFactory = $file_usage;
    return $this;
  }

  /**
   * Gets shared tempstore factory.
   *
   * @return \Drupal\user\SharedTempStoreFactory
   *   Shared tempstore factory.
   */
  public function getSharedTempStoreFactory() {
    if (empty($this->sharedTempStoreFactory)) {
      $this->sharedTempStoreFactory = \Drupal::service('user.shared_tempstore');
    }
    return $this->sharedTempStoreFactory;
  }

}
