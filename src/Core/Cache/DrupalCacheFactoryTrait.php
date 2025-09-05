<?php

namespace drunomics\ServiceUtils\Core\Cache;

use Drupal\Core\Cache\CacheBackendInterface;

/**
 * Provides convenient access to Drupal's cache backends.
 */
trait DrupalCacheFactoryTrait {

  /**
   * Returns a cache backend for the given bin.
   *
   * @param string $bin
   *   (optional) The cache bin name. Defaults to "default".
   *
   * @return \Drupal\Core\Cache\CacheBackendInterface
   *   The cache backend instance for the given bin.
   */
  protected function getCache(string $bin = 'default'): CacheBackendInterface {
    return \Drupal::cache($bin);
  }

}
