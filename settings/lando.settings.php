<?php

/**
 * @file
 * Settings for local development using Lando.
 */

if (getenv('LANDO_INFO')) {
  $lando_info = json_decode(getenv('LANDO_INFO'), TRUE);

  $databases['default']['default'] = [
    'driver' => 'mysql',
    'database' => $lando_info['database']['creds']['database'],
    'username' => $lando_info['database']['creds']['user'],
    'password' => $lando_info['database']['creds']['password'],
    'host' => $lando_info['database']['internal_connection']['host'],
    'port' => $lando_info['database']['internal_connection']['port'],
  ];

  // Salt for one-time login links, cancel links, form tokens, etc.
  $settings['hash_salt'] = getenv('DRUPAL_HASH_SALT');
}
