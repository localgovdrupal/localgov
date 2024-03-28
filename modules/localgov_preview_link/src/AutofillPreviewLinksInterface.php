<?php

namespace Drupal\localgov_preview_link;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Interface for autofilling preview links.
 */
interface AutofillPreviewLinksInterface {

  /**
   * Is the entity being previewed supported by this module?
   *
   * @return bool
   *   TRUE if the entity is supported, FALSE otherwise.
   */
  public function isSupported(): bool;

  /**
   * Get the entity being previewed.
   *
   * @return \Drupal\Core\Entity\ContentEntityInterface|NULL
   */
  public function getEntity(): ?ContentEntityInterface;

  /**
   * Get label.
   *
   * @return string
   *   The label to use for the preview link entity.
   */
  public function getLabel(): string;

  /**
   * Populate entities in preview link form.
   */
  public function autofillPreviewLinks(&$form, FormStateInterface $form_state): void;
}
