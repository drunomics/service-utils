<?php

namespace drunomics\ServiceUtils\Core\Render\MainContent;

use Drupal\Core\Render\MainContent\MainContentRendererInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait AjaxRendererTrait {

  /**
   * The ajax renderer.
   *
   * @var \Drupal\Core\Render\MainContent\MainContentRendererInterface
   */
  protected $ajaxRenderer;

  /**
   * Sets the ajax renderer.
   *
   * @param \Drupal\Core\Render\MainContent\MainContentRendererInterface $ajaxRenderer
   *   The ajax renderer.
   *
   * @return $this
   */
  public function setAjaxRenderer(MainContentRendererInterface $ajaxRenderer) {
    $this->AjaxRenderer = $ajaxRenderer;
    return $this;
  }

  /**
   * Gets the ajax renderer.
   *
   * @return \Drupal\Core\Render\MainContent\MainContentRendererInterface
   *   The ajax renderer.
   */
  public function getAjaxRenderer() {
    if (empty($this->AjaxRenderer)) {
      $this->AjaxRenderer = \Drupal::service('main_content_renderer.ajax');
    }
    return $this->AjaxRenderer;
  }

}
