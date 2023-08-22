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
