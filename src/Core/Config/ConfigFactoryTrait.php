<?php

namespace drunomics\ServiceUtils\Core\Config;

use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait ConfigFactoryTrait {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Sets the config factory.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The config factory.
   *
   * @return $this
   */
  public function setConfigFactory(ConfigFactoryInterface $configFactory) {
    $this->configFactory = $configFactory;
    return $this;
  }

  /**
   * Gets the config factory.
   *
   * @return \Drupal\Core\Config\ConfigFactoryInterface
   *   The config factory.
   */
  public function getConfigFactory() {
    if (empty($this->configFactory)) {
      $this->configFactory = \Drupal::service('config.factory');
    }
    return $this->configFactory;
  }

}
