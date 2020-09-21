<?php

/**
 * @file
 * Settings for local development using DDEV.
 */

$databases['default']['default'] = [
  'driver' => "mysql",
  'database' => "db",
  'username' => "db",
  'password' => "db",
  'host' => 'db',
  'port' => 3306,
];

// Don't use Symfony's APCLoader. ddev includes APCu; Composer's APCu loader has
// better performance.
$settings['class_loader_auto_detect'] = FALSE;
