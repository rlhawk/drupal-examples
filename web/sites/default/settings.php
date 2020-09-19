<?php

/**
 * @file
 * Drupal site-specific configuration file.
 *
 * For more information, see default.settings.php.
 */

$local_dev = getenv('IS_DDEV_PROJECT') || getenv('LANDO_INFO');
$global_settings_path = $app_root . '/../settings';
$private_path = $app_root . '/../private';

// Access control for update.php script.
$settings['update_free_access'] = FALSE;

// Load services definition file.
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

// The default list of directories that will be ignored by Drupal's file API.
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

// The default number of entities to update in a batch process.
$settings['entity_update_batch_size'] = 50;

// Entity update backup.
$settings['entity_update_backup'] = TRUE;

// Node migration type.
$settings['migrate_node_migrate_type_classic'] = FALSE;

$settings['file_public_path'] = $site_path . '/files';
$settings['file_private_path'] = '../private/files';

// Location of the site configuration files.
$settings['config_sync_directory'] = $app_root . '/../config/default';

// Global local development settings.
if (file_exists($global_settings_path . '/local.settings.php') && $local_dev) {
  include $global_settings_path . '/local.settings.php';
}
