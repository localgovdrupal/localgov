<?php

/**
 * @file
 * Enables modules and site configuration for a Localgov site installation.
 */

/**
 * Implements hook_page_attachments().
 */
function localgov_page_attachments(array &$attachments): void {
  foreach ($attachments['#attached']['html_head'] as &$html_head) {
    $name = $html_head[1];
    $core_version = \Drupal::VERSION;
    $parts = explode('.', $core_version);

    if ($name == 'system_meta_generator') {
      $tag = &$html_head[0];
      $tag['#attributes']['content'] = 'Drupal ' . $parts[0] . ' (LocalGov Drupal | https://localgovdrupal.org)';
    }
  }
}

/**
 * Implements hook_install_tasks().
 */
function localgov_install_tasks(array &$install_state): array {
  return [
    'localgov_post_install_task' => [
      'display_name' => t('Localgov post install'),
      'display' => TRUE,
    ],
  ];
}

/**
 * This is an install step, added by localgov_install_tasks().
 *
 * We use this step to call a hook to allow other localgov modules to set things
 * up as part of the site installation process that they can't do in their
 * install hooks.
 */
function localgov_post_install_task(): void {
  \Drupal::moduleHandler()->invokeAllWith('localgov_post_install', function (callable $hook, string $module) {
    $hook();
  });
}
