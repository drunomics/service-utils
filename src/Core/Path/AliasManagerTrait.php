<?php

namespace drunomics\ServiceUtils\Core\Path;

use Drupal\path_alias\AliasManagerInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait AliasManagerTrait {

  /**
   * The alias manager.
   *
   * @var \Drupal\path_alias\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * Sets the entity type.
   *
   * @param \Drupal\path_alias\AliasManagerInterface $aliasManager
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
   * @return \Drupal\path_alias\AliasManagerInterface
   *   The alias manager.
   */
  public function getAliasManager() {
    if (empty($this->aliasManager)) {
      $this->aliasManager = \Drupal::service('path_alias.manager');
    }
    return $this->aliasManager;
  }

}
