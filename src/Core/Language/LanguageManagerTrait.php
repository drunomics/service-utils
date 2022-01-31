<?php

namespace drunomics\ServiceUtils\Core\Language;

use Drupal\Core\Language\LanguageManagerInterface;

trait LanguageManagerTrait {
    /**
     * The config factory.
     *
     * @var \Drupal\Core\Language\LanguageManagerInterface
     */
    protected $languageManager;

    /**
     * Sets the config factory.
     *
     * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
     *   The config factory.
     *
     * @return $this
     */
    public function setConfigFactory(LanguageManagerInterface $languageManager) {
        $this->languageManager = $languageManager;
        return $this;
    }

    /**
     * Gets the config factory.
     *
     * @return \Drupal\Core\Language\LanguageManagerInterface
     *   The config factory.
     */
    public function getConfigFactory() {
        if (empty($this->languageManager)) {
            $this->languageManager = \Drupal::service('language_manager');
        }
        return $this->languageManager;
    }

}