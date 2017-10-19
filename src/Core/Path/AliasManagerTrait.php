<?php

namespace drunomics\ServiceUtils\Core\Path;

use Drupal\Core\Path\AliasManagerInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait AliasManagerTrait {

  /**
   * The alias manager.
   *
   * @var \Drupal\Core\Path\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * Sets the entity type.
   *
   * @param \Drupal\Core\Path\AliasManagerInterface $aliasManager
   *   The alias manager.
   *
   * @return $this
   */
  public function setAliasManager(AliasManagerInterface $aliasManager) {
    $this->aliasManager = $aliasManager;
    return $this;
  }

  /**
   * Gets the entity repository.
   *
   * @return \Drupal\Core\Path\AliasManagerInterface $aliasManager
   *   The alias manager.
   */
  public function getAliasManager() {
    if (empty($this->aliasManager)) {
      $this->aliasManager = \Drupal::service('path.alias_manager');
    }
    return $this->aliasManager;
  }

}
