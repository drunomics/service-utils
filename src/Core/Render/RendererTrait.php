<?php

namespace drunomics\ServiceUtils\Core\Render;

use Drupal\Core\Render\RendererInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait RendererTrait {

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Sets the renderer.
   *
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   *
   * @return $this
   */
  public function setrenderer(RendererInterface $renderer) {
    $this->renderer = $renderer;
    return $this;
  }

  /**
   * Gets the renderer.
   *
   * @return \Drupal\Core\Render\RendererInterface
   *   The renderer.
   */
  public function getrenderer() {
    if (empty($this->renderer)) {
      $this->renderer = \Drupal::service('renderer');
    }
    return $this->renderer;
  }

}
