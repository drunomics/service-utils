<?php

namespace drunomics\ServiceUtils\file\FileUsage;

use Drupal\file\FileUsage\FileUsageInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait FileUsageTrait {

  /**
   * The database file usage.
   *
   * @var \Drupal\file\FileUsage\FileUsageInterface
   */
  protected $fileUsage;

  /**
   * Sets the database file usage.
   *
   * @param \Drupal\file\FileUsage\FileUsageInterface $file_usage
   *   The database file usage.
   *
   * @return $this
   */
  public function setFileUsage(FileUsageInterface $file_usage) {
    $this->fileUsage = $file_usage;
    return $this;
  }

  /**
   * Gets the database file usage.
   *
   * @return \Drupal\file\FileUsage\FileUsageInterface
   *   The database file usage.
   */
  public function getFileUsage() {
    if (empty($this->fileUsage)) {
      $this->fileUsage = \Drupal::service('file.usage');
    }
    return $this->fileUsage;
  }

}