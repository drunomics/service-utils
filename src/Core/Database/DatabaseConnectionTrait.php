<?php

namespace drunomics\ServiceUtils\Core\Database;

use Drupal\Core\Database\Connection;

/**
 * Allows setter injection and simple usage of the service.
 */
trait DatabaseConnectionTrait {

  /**
   * The database connection service.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Sets database connection.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection service.
   *
   * @return \Drupal\Core\Database\Connection
   */
  public function setDatabaseConnection(Connection $connection) {
    $this->connection = $connection;
    return $this;
  }

  /**
   * Gets database connection service.
   *
   * @return \Drupal\Core\Database\Connection
   *   The database connection service.
   */
  public function getDatabaseConnection() {
    if (empty($this->connection)) {
      $this->connection = \Drupal::service('database');
    }
    return $this->connection;
  }

}
