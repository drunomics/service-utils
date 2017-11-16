<?php

namespace drunomics\ServiceUtils\file\FileUsage;

use Drupal\file\FileUsage\FileUsageInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait FileUsageTrait {

  /**
   * File usage service.
   *
   * @var \Drupal\file\FileUsage\FileUsageInterface
   */
  protected $fileUsage;

  /**
   * Sets file usage service.
   *
   * @param \Drupal\file\FileUsage\FileUsageInterface $file_usage
   *   File usage service.
   *
   * @return $this
   */
  public function setFileUsage(FileUsageInterface $file_usage) {
    $this->fileUsage = $file_usage;
    return $this;
  }

  /**
   * Gets file usage service.
   *
   * @return \Drupal\file\FileUsage\FileUsageInterface
   *   File usage service.
   */
  public function getFileUsage() {
    if (empty($this->fileUsage)) {
      $this->fileUsage = \Drupal::service('file.usage');
    }
    return $this->fileUsage;
  }

}
