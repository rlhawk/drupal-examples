<?php

// @codingStandardsIgnoreFile

/**
 * @file
 * Default settings for local development.
 */

// Settings for local development using DDEV.
if (file_exists($global_settings_path . '/ddev.settings.php') && getenv('IS_DDEV_PROJECT')) {
  include $global_settings_path . '/ddev.settings.php';
}

// Settings for local development using Lando.
if (file_exists($global_settings_path . '/lando.settings.php') && getenv('LANDO_INFO')) {
  include $global_settings_path . '/lando.settings.php';
}

// Allow any hosts.
$settings['trusted_host_patterns'] = ['.*'];

// Assertions.
assert_options(ASSERT_ACTIVE, TRUE);
\Drupal\Component\Assertion\Handle::register();

// Enable local development services.
if (file_exists($app_root . '/sites/development.services.yml')) {
  $settings['container_yamls'][] = $app_root . '/sites/development.services.yml';
}
if (file_exists($global_settings_path . '/local.services.yml')) {
  $settings['container_yamls'][] = $global_settings_path . '/local.services.yml';
}

// Show all error messages, with backtrace information.
$config['system.logging']['error_level'] = 'verbose';

// Disable CSS and JS aggregation.
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

// Disable the render cache.
$settings['cache']['bins']['render'] = 'cache.backend.null';

// Disable Internal Page Cache.
$settings['cache']['bins']['page'] = 'cache.backend.null';

// Disable Dynamic Page Cache.
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

// Skip file system permissions hardening.
$settings['skip_permissions_hardening'] = TRUE;

// Enable Local configuration split.
$config['config_split.config_split.local']['status'] = TRUE;

// Custom local settings.
if (file_exists($private_path . '/local.settings.php')) {
  include $private_path . '/local.settings.php';
}

// Salt for one-time login links, cancel links, form tokens, etc. If no salt
// has yet been defined in $settings, look for one in an environment variable.
// If the variable does not exist, generate a random salt.
if (empty($settings['hash_salt'])) {
  $hash_salt = getenv('DRUPAL_HASH_SALT');
  if (!$hash_salt) {
    $encoded_random_bytes = base64_encode(random_bytes(55));
    $search = ['+', '/', '='];
    $replace = ['-', '_', ''];
    $hash_salt = str_replace($search, $replace, $encoded_random_bytes);
  }
  $settings['hash_salt'] = $hash_salt;
}
