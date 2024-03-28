<?php

namespace Drupal\localgov_preview_link;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\node\NodeInterface;
use Drupal\preview_link\Entity\PreviewLink;

/**
 * Utility class for autofilling preview links.
 */
class AutofillPreviewLinks implements AutofillPreviewLinksInterface {

  /**
   * Supported content types.
   *
   * @var array
   */
  protected array $supportedContentTypes = [
    'guide' => [
      'localgov_guides_overview',
      'localgov_guides_page',
    ],
  ];

  /**
   * The current route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface $routeMatch;
   */
  protected RouteMatchInterface $routeMatch;

  /**
   * The entity being previewed.
   *
   * @var \Drupal\Core\Entity\ContentEntityInterface|NULL
   */
  protected ?ContentEntityInterface $entity = NULL;

  /**
   * Constructs an AutofillPreviewLinks object.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match service.
   */
  public function __construct(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;

    // Get the entity being previewed.
    $entityParameterName = $this->routeMatch->getRouteObject()->getOption('preview_link.entity_type_id');
    if (!is_null($entityParameterName)) {
      $this->entity = $this->routeMatch->getParameter($entityParameterName);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function isSupported(): bool {
    if (!is_null($this->entity)) {
      $bundle = $this->entity->bundle();
      foreach ($this->supportedContentTypes as $bundles) {
        if (in_array($bundle, $bundles)) {
          return TRUE;
        }
      }
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntity(): ?ContentEntityInterface {
    return $this->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel(): string {
    if (!is_null($this->entity)) {
      $bundle = $this->entity->bundle();
      foreach ($this->supportedContentTypes as $label => $bundles) {
        if (in_array($bundle, $bundles)) {
          return $label;
        }
      }
    }

    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function autofillPreviewLinks(&$form, FormStateInterface $form_state): void {
    if (is_null($this->entity)) {
      return;
    }

    $preview_link = $form_state->getFormObject()->getEntity();
    if (!$preview_link instanceof PreviewLink) {
      return;
    }

    // Get all entities to be previewed.
    $entities = [];
    $bundle = $this->entity->bundle();
    if ($bundle == 'localgov_guides_overview' || $bundle == 'localgov_guides_page') {
      $entities = $this->getGuideNodes($this->entity);
    }

    // Add entities to preview link.
    $current_entities = $preview_link->getEntities();
    foreach ($entities as $entity) {
      $found = FALSE;
      foreach ($current_entities as $current_entity) {
        if ($current_entity->id() == $entity->id()) {
          $found = TRUE;
          break;
        }
      }
      if (!$found) {
        $preview_link->addEntity($entity);
      }
    }
    $preview_link->save();
  }

  /**
   * Get all the nodes that belong to a guide.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The guide to get nodes for.
   *
   * @return \Drupal\node\NodeInterface[]
   */
  protected function getGuideNodes(NodeInterface $node): array {
    $guide_nodes = [];

    // Find guide overview.
    if ($node->bundle() == 'localgov_guides_overview') {
      $overview = $node;
    }
    elseif ($node->bundle() == 'localgov_guides_page') {
      $overview = $node->get('localgov_guides_parent')->entity;
    }
    $guide_nodes[] = $overview;

    // Find guide pages.
    $guide_pages = $overview->get('localgov_guides_pages')->referencedEntities();
    foreach ($guide_pages as $guide_page) {
      if ($guide_page instanceof NodeInterface && $guide_page->access('view')) {
        $guide_nodes[] = $guide_page;
      }
    }

    return $guide_nodes;
  }

}
