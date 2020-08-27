<?php

namespace drunomics\ServiceUtils\pathauto;

use Drupal\pathauto\PathautoGeneratorInterface;

/**
 * Allows setter injection and simple usage of the pathauto.generator service.
 */
trait PathautoGeneratorTrait {

  /**
   * The pathauto generator service.
   *
   * @var \Drupal\pathauto\PathautoGeneratorInterface
   */
  protected $pathautoGenerator;

  /**
   * Sets the pathauto generator service.
   *
   * @param \Drupal\pathauto\PathautoGeneratorInterface $pathautoGenerator
   *   The pathauto generator service.
   *
   * @return $this
   */
  public function setPathautoGenerator(PathautoGeneratorInterface $pathautoGenerator) {
    $this->pathautoGenerator = $pathautoGenerator;
    return $this;
  }

  /**
   * Gets the pathauto generator service.
   *
   * @return \Drupal\pathauto\PathautoGeneratorInterface
   *   The pathauto generator service.
   */
  public function getPathautoGenerator() {
    if (empty($this->pathautoGenerator)) {
      $this->pathautoGenerator = \Drupal::service('pathauto.generator');
    }
    return $this->pathautoGenerator;
  }

}
