<?php

namespace drunomics\ServiceUtils\Core\Entity;

use Drupal\Core\Entity\EntityRepositoryInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait EntityRepositoryTrait {

  /**
   * The entity repository.
   *
   * @var \Drupal\Core\Entity\EntityRepositoryInterface
   */
  protected $entityRepository;

  /**
   * Sets the entity type.
   *
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entityRepository
   *   The entity repository.
   *
   * @return $this
   */
  public function setEntityRepository(EntityRepositoryInterface $entityRepository) {
    $this->entityRepository = $entityRepository;
    return $this;
  }

  /**
   * Gets the entity repository.
   *
   * @return \Drupal\Core\Entity\EntityRepositoryInterface
   *   The entity repository.
   */
  public function getEntityRepository() {
    if (empty($this->entityRepository)) {
      $this->entityRepository = \Drupal::service('entity.repository');
    }
    return $this->entityRepository;
  }

}
