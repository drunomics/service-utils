<?php

namespace drunomics\ServiceUtils\Core\Plugin;

use Drupal\Core\Block\BlockManager;

/**
 * Allows setter injection and simple usage of the service.
 */
trait BlockManagerTrait {

  /**
   * The plugin block manager.
   *
   * @var \Drupal\Core\Block\BlockManagerInterface
   */
  protected $blockManager;

  /**
   * Sets the block manager.
   *
   * @param \Drupal\Core\Block\BlockManager $blockManager
   *   The block manager.
   *
   * @return $this
   */
  public function setBlockManager(BlockManager $blockManager) {
    $this->blockManager = $blockManager;
    return $this;
  }

  /**
   * Gets the plugin block manager.
   *
   * @return \Drupal\Core\Block\BlockManager
   *   The block manager.
   */
  public function getBlockManager() {
    if (empty($this->blockManager)) {
      $this->blockManager = \Drupal::service('plugin.manager.block');
    }
    return $this->blockManager;
  }

}
