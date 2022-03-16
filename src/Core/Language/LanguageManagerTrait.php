<?php

namespace drunomics\ServiceUtils\Core\Language;

use Drupal\Core\Language\LanguageManagerInterface;

/**
 * Allows setter injection and simple usage of the service.
 */
trait LanguageManagerTrait {

  /**
   * The language mamnager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * Sets the language manager.
   *
   * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
   *   The language manager.
   *
   * @return $this
   */
  public function setLanguageManager(LanguageManagerInterface $languageManager) {
    $this->languageManager = $languageManager;
    return $this;
  }

  /**
   * Gets the language manager.
   *
   * @return \Drupal\Core\Language\LanguageManagerInterface
   *   The language manager.
   */
  public function getLanguageManager() {
    if (empty($this->languageManager)) {
      $this->languageManager = \Drupal::service('language_manager');
    }
    return $this->languageManager;
  }

}
