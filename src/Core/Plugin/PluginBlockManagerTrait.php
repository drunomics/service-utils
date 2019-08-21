<?php

namespace drunomics\ServiceUtils\Core\Entity;

use Drupal\Core\Block\BlockManagerInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait PluginBlockManagerTrait {

  /**
   * The plugin block manager.
   *
   * @var \Drupal\Core\Block\BlockManagerInterface
   */
  protected $blockManager;

  /**
   * Sets the block manager.
   *
   * @param \Drupal\Core\Block\BlockManagerInterface $blockManager
   *   The block manager.
   *
   * @return $this
   */
  public function setPluginBlockManager(BlockManagerInterface $blockManager) {
    $this->blockManager = $blockManager;
    return $this;
  }

  /**
   * Gets the plugin block manager.
   *
   * @return \Drupal\Core\Entity\BlockManagerInterface
   *   The block manager.
   */
  public function getPluginBlockManager() {
    if (empty($this->blockManager)) {
      $this->blockManager = \Drupal::blockManager();
    }
    return $this->blockManager;
  }

}
