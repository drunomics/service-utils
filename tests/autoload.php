<?php

/**
 * @file
 * Customizes auto-loading so that namespaces of modules are registered.
 */

use Composer\Autoload\ClassLoader;

require_once __DIR__ . '/../vendor/autoload.php';

$classLoader = new ClassLoader();
$classLoader->addPsr4("Drupal\\file\\", __DIR__ . '/../vendor/drupal/core/modules/file/src');
$classLoader->addPsr4("Drupal\\path_alias\\", __DIR__ . '/../vendor/drupal/core/modules/path_alias/src');
$classLoader->addPsr4("Drupal\\user\\", __DIR__ . '/../vendor/drupal/core/modules/user/src');
$classLoader->addPsr4("Drupal\\pathauto\\", __DIR__ . '/../vendor/drupal/pathauto/src');
$classLoader->register();
