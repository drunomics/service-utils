<?php

namespace drunomics\ServiceUtils\Core\File;

/**
 * Allows setter injection and simple usage of the service.
 */
trait FileUrlGeneratorTrait {

  /**
   * The file URL generator.
   *
   * @var \Drupal\Core\File\FileUrlGeneratorInterface
   */
  protected $fileUrlGenerator;

  /**
   * Returns the file URL generator.
   *
   * This is provided for BC as sub-classes may not call the parent constructor.
   *
   * @return \Drupal\Core\File\FileUrlGeneratorInterface
   *   The file URL generator.
   */
  public function getFileUrlGenerator() {
    if (!$this->fileUrlGenerator) {
      $this->fileUrlGenerator = \Drupal::service('file_url_generator');
    }
    return $this->fileUrlGenerator;
  }

}
