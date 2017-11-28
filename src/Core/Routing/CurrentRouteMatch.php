<?php

namespace drunomics\ServiceUtils\Core\Routing;

use Drupal\Core\Routing\ResettableStackedRouteMatchInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait CurrentRouteMatchTrait {

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\ResettableStackedRouteMatchInterface
   */
  protected $currentRouteMatch;

  /**
   * Sets the entity type.
   *
   * @param \Drupal\Core\Routing\ResettableStackedRouteMatchInterface $currentRouteMatch
   *   The current route match.
   *
   * @return $this
   */
  public function setCurrentRouteMatch(ResettableStackedRouteMatchInterface $currentRouteMatch) {
    $this->currentRouteMatch = $currentRouteMatch;
    return $this;
  }

  /**
   * Gets the current route match.
   *
   * @return \Drupal\Core\Routing\ResettableStackedRouteMatchInterface
   *   The alias manager.
   */
  public function getCurrentRouteMatch() {
    if (empty($this->currentRouteMatch)) {
      $this->currentRouteMatch = \Drupal::service('current_route_match');
    }
    return $this->currentRouteMatch;
  }

}
