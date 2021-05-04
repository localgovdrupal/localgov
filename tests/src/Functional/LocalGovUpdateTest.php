<?php

namespace Drupal\Tests\localgov\Functional;

use Drupal\FunctionalTests\Update\UpdatePathTestBase;

/**
 * Test LocalGov updates.
 */
class LocalGovUpdateTest extends UpdatePathTestBase {

  /**
   * {@inheritdoc}
   */
  //protected static $modules = ['localgov_update_test'];

  /**
   * {@inheritdoc}
   */
  public function setDatabaseDumpFiles() {
    $this->databaseDumpFiles = [
      __DIR__ . '/../../fixtures/localgov-1.0.0.php.gz',
    ];
  }

  /**
   * Tests LocalGov updates from 1.0.0 to current.
   */
  public function testUpdate() {
    $this->runUpdates();
    $this->rebuildContainer();
  }

}
