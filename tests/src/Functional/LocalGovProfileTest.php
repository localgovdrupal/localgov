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
   * Test localgov profile was installed and basic site functions.
   */
  public function testLocalGovDrupalProfile() {

    // Test localgov_core module is enabled and is not uninstallable.
    $this->assertTrue($this->container->get('module_handler')->moduleExists('localgov_core'));
    try {
      $this->container->get('module_installer')->uninstall(['localgov_core']);
      $this->fail('Uninstalled localgov_core module.');
    }
    catch (ModuleUninstallValidatorException $e) {
      $this->assertStringContainsString('module is required', $e->getMessage());
    }

    // Test localgov_core:localgov_roles submodule is enabled.
    $this->assertTrue($this->container->get('module_handler')->moduleExists('localgov_roles'));

    // Test front page loads after site install.
    $this->drupalGet('<front>');
    $this->assertSession()->statusCodeEquals(Response::HTTP_OK);

    // Admin pages are not accessible to anonymous users.
    $this->drupalGet('admin');
    $this->assertSession()->statusCodeEquals(Response::HTTP_FORBIDDEN);

    // Admin pages are accessible to administrators.
    $adminUser = $this->createUser([
      'access administration pages',
    ]);
    $this->drupalLogin($adminUser);
    $this->drupalGet('admin');
    $this->assertSession()->statusCodeEquals(Response::HTTP_OK);
  }

}
