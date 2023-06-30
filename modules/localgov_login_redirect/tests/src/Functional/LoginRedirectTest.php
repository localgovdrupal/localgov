<?php

namespace Drupal\Tests\localgov_login_redirect\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Functional tests for LocalGovDrupal install profile.
 */
class LoginRedirectTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $profile = 'localgov';

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'localgov_login_redirect',
  ];

  /**
   * Test redirect at login.
   */
  public function testRedirectAtLogin() {

    // Check user with no permissions lands on default user login page.
    $user1 = $this->drupalCreateUser([]);
    $this->drupalGet('user/login');
    $edit = ['name' => $user1->getAccountName(), 'pass' => $user1->passRaw];
    $this->submitForm($edit, 'Log in');
    $this->assertSession()->addressEquals('user/' . $user1->id());
    $this->drupalLogout();

    // Check user with view content overview permission lands on content page.
    $user2 = $this->drupalCreateUser(['access content overview']);
    $this->drupalGet('user/login');
    $edit = ['name' => $user2->getAccountName(), 'pass' => $user2->passRaw];
    $this->submitForm($edit, 'Log in');
    $this->assertSession()->addressEquals('admin/content');
    $this->drupalLogout();

    // Ensure the destination parameter is not overwritten.
    $user3 = $this->drupalCreateUser([]);
    $this->drupalGet('user/login', ['query' => ['destination' => 'foo']]);
    $edit = ['name' => $user3->getAccountName(), 'pass' => $user3->passRaw];
    $this->submitForm($edit, 'Log in');
    $this->assertSession()->addressEquals('foo');
    $this->drupalLogout();

    // Ensure password reset links are not redirected.
    $user4 = $this->drupalCreateUser(['access content overview']);
    $reset_link = user_pass_reset_url($user4);
    $this->drupalGet($reset_link);
    $this->assertSession()->addressEquals('user/reset/' . $user4->id());
  }

}
