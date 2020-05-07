<?php

namespace Drupal\Tests\localgov\Functional;

use Drupal\Core\Extension\ModuleUninstallValidatorException;
use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional tests for LocalGovDrupal install profile.
 */
class LocalGovProfileTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $profile = 'localgov';

  /**
   * Test core modules enabled and uninstallable.
   */
  public function testDependenciesInstalledAndUninstallable() {
    $this->assertTrue($this->container->get('module_handler')->moduleExists('localgov_core'));
    try {
      $this->container->get('module_installer')->uninstall(['localgov_core']);
      $this->fail('Uninstalled localgov_core module.');
    }
    catch (ModuleUninstallValidatorException $e) {
      $this->assertContains('module is required', $e->getMessage());
    }
  }

  /**
   * Test front page loads after site install.
   */
  public function testFrontPageLoadsForAnonymousUsers() {
    $this->drupalGet('<front>');
    $this->assertResponse(Response::HTTP_OK);
  }

  /**
   * Admin pages are not accessible to anonymous users.
   */
  public function testAdminPageIsNotAccessibleToAnonymousUsers() {
    $this->drupalGet('admin');
    $this->assertResponse(Response::HTTP_FORBIDDEN);
  }

  /**
   * Admin pages are accessible to administrators.
   */
  public function testAdminPageIsAccessibleByAdminUsers() {
    $adminUser = $this->createUser([
      'access administration pages',
    ]);
    $this->drupalLogin($adminUser);
    $this->drupalGet('admin');
    $this->assertResponse(Response::HTTP_OK);
  }

}
