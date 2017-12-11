<?php

namespace drunomics\ServiceUtils\Core\File;

use Drupal\Core\File\FileSystemInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait FileSystemTrait {

  /**
   * The file system.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * Sets the file system.
   *
   * @param \Drupal\Core\File\FileSystemInterface $fileSystem
   *   The file system.
   *
   * @return $this
   */
  public function setFileSystem(FileSystemInterface $fileSystem) {
    $this->fileSystem = $fileSystem;
    return $this;
  }

  /**
   * Gets the file system.
   *
   * @return \Drupal\Core\File\FileSystemInterface
   *   The file system.
   */
  public function getFileSystem() {
    if (empty($this->fileSystem)) {
      $this->fileSystem = \Drupal::service('file_system');
    }
    return $this->fileSystem;
  }

}
