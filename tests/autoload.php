<?php

/**
 * @file
 * Customizes auto-loading so that namespaces of modules are registered.
 */

require_once __DIR__ . '/../vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("Drupal\\file\\", __DIR__ . '/../vendor/drupal/core/modules/file/src');
$classLoader->addPsr4("Drupal\\user\\", __DIR__ . '/../vendor/drupal/core/modules/user/src');
$classLoader->register();
