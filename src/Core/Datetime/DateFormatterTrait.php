<?php

namespace drunomics\ServiceUtils\Core\Datetime;

/**
 * Allows setter injection and simple usage of the service.
 */
trait DateFormatterTrait {

  /**
   * Date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * Gets the date formatter.
   *
   * @todo Add trait for proper dependency injection.
   *
   * @return \Drupal\Core\Datetime\DateFormatter
   *   The date formatter.
   */
  public function getDateFormatter() {
    if (!isset($this->dateFormatter)) {
      $this->dateFormatter = \Drupal::service('date.formatter');
    }
    return $this->dateFormatter;
  }

}
