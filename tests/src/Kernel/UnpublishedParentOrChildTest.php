<?php

declare(strict_types = 1);

namespace Drupal\Tests\localgov\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\node\Traits\NodeCreationTrait;
use Drupal\Tests\user\Traits\UserCreationTrait;

/**
 * Entity reference tests.
 *
 * We should be able to reference unpublished Guide overview or Guide pages from
 * each other.  This fails due to a core bug but taken care of by a patch.
 *
 * @see https://www.drupal.org/node/2845144
 */
class UnpublishedParentOrChildTest extends KernelTestBase {

  use NodeCreationTrait;
  use UserCreationTrait;

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = [
    'system',
    'filter',
    'field',
    'text',
    'options',
    'user',
    'node',
    'views',
    'localgov_roles',
    'localgov_core',
    'localgov_guides',
    'localgov_step_by_step',
  ];

  /**
   * {@inheritdoc}
   *
   * Sets up:
   * - A user with guide related permissions of the localgov_editor role.
   */
  protected function setUp(): void {

    parent::setUp();

    $this->installSchema('system', ['sequences']);
    $this->installSchema('node', ['node_access']);
    $this->installEntitySchema('user');
    $this->installEntitySchema('node');
    $this->installConfig(self::$modules);

    $editor_role = $this->container->get('entity_type.manager')->getStorage('user_role')->load('localgov_editor');

    $editor_permissions = $editor_role->getPermissions();
    $editor_permissions_subset_tmp = array_filter($editor_permissions, fn($perm) => preg_match('#(content|revisions|revisions|version)$#', $perm));
    $editor_permissions_subset = array_filter($editor_permissions_subset_tmp, fn($perm) => strpos($perm, 'localgov_services') === FALSE);
    $authenticated_user_permissions_subset = ['access content'];

    // Setup Editor user.
    $this->setUpCurrentUser([
      'name'  => 'editor0',
      'mail'  => 'editor0@example.net',
      'roles' => ['authenticated', 'localgov_editor'],
    ], $authenticated_user_permissions_subset + $editor_permissions_subset);
  }

  /**
   * Test for *unpublished* parent and child selection.
   *
   * Assertions:
   * - A Guide page should be able to use an unpublished Guide overview page as
   *   its parent.
   * - A Guide overview page should be able to use an unpublished Guide page as
   *   its child.
   * - A Step by Step page should be able to use an unpublished
   *   Step by Step overview page as its parent.
   * - A Step by Step overview page should be able to use an unpublished
   *   Step by Step page as its child.
   */
  public function testUnpublishedParentAndChildSelection() :void {

    // Guide.
    $guide_overview = $this->createNode([
      'title'  => 'An unpublished Guide overview page',
      'type'   => 'localgov_guides_overview',
      'status' => 0,
    ]);
    $this->assertCount(0, $guide_overview->validate(), 'Guide overview page fails validation.');

    $guide_page = $this->createNode([
      'title'  => 'An unpublished Guide page',
      'type'   => 'localgov_guides_page',
      'status' => 0,
      'localgov_guides_section_title' => 'An unpublished Guide page',
      'localgov_guides_parent' => ['target_id' => $guide_overview->id()],
    ]);
    $this->assertCount(0, $guide_page->validate(), 'Guide page fails validation after referencing an unpublished Guide overview page as a parent page.');

    $updated_guide_overview = $this->container->get('entity_type.manager')->getStorage('node')->load($guide_overview->id());
    $this->assertCount(0, $updated_guide_overview->validate(), 'Guide overview page fails validation after referencing an unpublished Guide page as a child page.');

    // Step by Step.
    $step_by_step_overview = $this->createNode([
      'title'  => 'An unpublished Step by Step overview page',
      'type'   => 'localgov_step_by_step_overview',
      'status' => 0,
    ]);
    $this->assertCount(0, $step_by_step_overview->validate(), 'Step by Step overview page fails validation.');

    $step_by_step_page = $this->createNode([
      'title'  => 'An unpublished Step by Step page',
      'type'   => 'localgov_step_by_step_page',
      'status' => 0,
      'localgov_step_section_title' => 'An unpublished Step by Step page',
      'localgov_step_parent' => ['target_id' => $step_by_step_overview->id()],
    ]);
    $this->assertCount(0, $step_by_step_page->validate(), 'Step by Step page fails validation after referencing an unpublished Step by Step overview page as a parent page.');

    $updated_guide_overview = $this->container->get('entity_type.manager')->getStorage('node')->load($step_by_step_overview->id());
    $this->assertCount(0, $updated_guide_overview->validate(), 'Step by Step overview page fails validation after referencing an unpublished Step by Step page as a child page.');
  }

}
