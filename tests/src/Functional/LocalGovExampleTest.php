<?php

/**
 * @file
 * Contains \Drupal\Tests\localgov\Functional\LocalGovExmapleTest.
 */

namespace Drupal\Tests\localgov\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Example tests for LocalGovDrupal.
 *
 * For more information on the tests defined here see:
 * https://github.com/opdavies/workshop-drupal-automated-testing
 */
class LocalGovExmapleTest extends BrowserTestBase {

  protected $profile = 'localgov';

   /** @test */
  public function the_front_page_loads_for_anonymous_users() {
    $this->drupalGet('<front>');

    $this->assertResponse(Response::HTTP_OK);
  }

}
