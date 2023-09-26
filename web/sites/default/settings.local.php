<?php
/**
 * @file
 * Auto-generated file by setup-local.
 * If project.local.settings.php existed when this file was generated
 * then its content added to this file.
 */

// Include Drupal Dev's settings.php with settings and overrides for local dev
// envs.
$drupal_dev_do_not_include_settings_local_php = TRUE;
include "{$app_root}/{$site_path}/settings.drupal-dev.php";

$settings['trusted_host_patterns'][] = '^webserver-dp-beta$';
$settings['trusted_host_patterns'][] = '^webserver-dp-beta.local.pronovix.net$';

// Include project.local.settings.php with project specific default local
// overrides for development environments if exists.
$local_project_overrides = "{$app_root}/{$site_path}/project.local.settings.php";
if (file_exists($local_project_overrides)) {
  include $local_project_overrides;
}
