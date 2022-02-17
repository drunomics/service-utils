<?php

namespace drunomics\ServiceUtils\Core\Extension;

use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait ModuleHandlerTrait {

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Sets the module handler.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The module handler.
   *
   * @return $this
   */
  public function setModuleHandler(ModuleHandlerInterface $moduleHandler) {
    $this->moduleHandler = $moduleHandler;
    return $this;
  }

  /**
   * Gets the module handler.
   *
   * @return \Drupal\Core\Extension\ModuleHandlerInterface
   *   The module handler.
   */
  public function getModuleHandler() {
    if (empty($this->moduleHandler)) {
      $this->moduleHandler = \Drupal::service('module_handler');
    }
    return $this->moduleHandler;
  }

}
