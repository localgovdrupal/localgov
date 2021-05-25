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
  public function setDatabaseDumpFiles() {
    $this->databaseDumpFiles = [
      __DIR__ . '/../../fixtures/localgov-1.0.0.php.gz',
    ];
  }

  /**
   * Tests LocalGov updates from 1.0.0 to current.
   */
  public function testUpdate() {

    // Test Drupal update to latest version.
    $this->runUpdates();
    $this->rebuildContainer();

    // Test Service landing page: Adult health and social care.
    $this->drupalGet('/adult-health-and-social-care');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Adult health and social care');
    $this->assertSession()->elementTextContains('css', 'header p', 'Advice and support for adult health and social care');
    $this->assertSession()->elementTextContains('css', '.block-localgov-service-cta-block nav', 'Find out about meals on wheels');
    $this->assertSession()->elementTextContains('css', '.block-localgov-service-cta-block nav', 'Request help for an adult');
    $this->assertSession()->elementTextContains('css', 'main .servicehub--more h3', 'Support in your home');
    $this->assertSession()->elementTextContains('css', 'main .servicehub--more p', 'Support and equipment to help you live independently and safely.');
    $this->assertSession()->elementTextContains('css', 'main .servicehub--status h3', 'Service updates');
    $this->assertSession()->elementTextContains('css', 'main .servicehub--update_inner', 'Adult social care service is working normally');
    $this->assertSession()->elementTextContains('css', 'main .contact-container h2', 'Contact this service');
    $this->assertSession()->elementTextContains('css', 'main .contact-container', 'Send us a message');
    $this->assertSession()->elementTextContains('css', 'main .contact-container', '555 111 222 333');
    $this->assertSession()->elementTextContains('css', 'main .contact-container', 'Opening times');
    $this->assertSession()->elementTextContains('css', 'main .contact-container .contact-title', 'Agile Collective');
    $this->assertSession()->elementTextContains('css', 'main .contact-container .contact-bottom', 'If you have hearing or speech difficulties, please call 555 111 222 333');
    $this->assertSession()->elementTextContains('css', 'main .sidebar', 'Popular topics');
    $this->assertSession()->elementTextContains('css', 'main .sidebar', 'Garden waste');
    $this->assertSession()->elementTextContains('css', 'main .sidebar', 'Parks and gardens');

    // Test Service sub-landing page: Another service landing page.
    $this->drupalGet('/adult-health-and-social-care/another-service-landing-page');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Another service landing page');
    $this->assertSession()->elementTextContains('css', 'header p', 'Morbi porta tortor ac felis placerat, nec sodales justo tincidunt.');
    $this->assertSession()->elementTextContains('css', 'main article h2', 'Child pages');
    $this->assertSession()->elementTextContains('css', 'main article', 'Example external link');

    // Test Service page: Occupational Therapy and equipment.
    $this->drupalGet('/adult-health-and-social-care/support-your-home/occupational-therapy-and-equipment-helping-you-stay');
    $this->assertSession()->elementTextContains('css', '.block-system-breadcrumb-block', 'Adult health and social care');
    $this->assertSession()->elementTextContains('css', '.block-system-breadcrumb-block', 'Support in your home');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Occupational Therapy and equipment: helping you stay at home');
    $this->assertSession()->elementTextContains('css', 'header p', 'We provide advice and support to help you live independently if you\'re older, disabled, or have a long-term illness.');
    $this->assertSession()->elementTextContains('css', 'main article h2', 'Choosing the right everyday equipment and adaptations');
    $this->assertSession()->elementTextContains('css', 'main article p', 'To help you stay at home, you can:');

    // Test Service statuses.
    $this->drupalGet('/service-status');
    $this->assertSession()->elementTextContains('css', 'main h1', 'Council service updates');
    $this->assertSession()->elementTextContains('css', 'main p', 'We will keep this page updated with all the latest changes to our services.');
    $this->assertSession()->elementTextContains('css', '.service-status h2', 'Registry office is closed until further notice');

    // Test Service status: Adult social care service is working normally.
    $this->drupalGet('/adult-health-and-social-care/status/adult-social-care-service-working-normally');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Adult social care service is working normally');
    $this->assertSession()->elementTextContains('css', '.region-content-top', 'fine now, nothing to see here');
    $this->assertSession()->elementTextContains('css', 'main article p', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

    // Test Guide overview page: Blue badges.
    $this->drupalGet('/adult-health-and-social-care/travel-passes-and-support/blue-badges');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Blue Badges');
    $this->assertSession()->elementTextContains('css', '.block-localgov-guides nav', 'About Blue Badges');
    $this->assertSession()->elementTextContains('css', '.block-localgov-guides nav', 'Blue Badges for organisations');
    $this->assertSession()->elementTextContains('css', 'main article h2', 'Overview');
    $this->assertSession()->elementTextContains('css', 'main article p', 'Blue Badges give disabled people who rely on car travel, but face challenges in getting from the car to their destination, the ability to park close-by.');
    $this->assertSession()->elementTextContains('css', '.localgov_guides--navigation a', 'Next');

    // // Test Guide page: Apply for a blue badge.
    // $this->drupalGet('/adult-health-and-social-care/travel-passes-and-support/blue-badges/apply-blue-badge');
    $this->clicklink('Apply for a Blue Badge');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Blue Badges');
    $this->assertSession()->elementTextContains('css', '.block-localgov-guides nav', 'About Blue Badges');
    $this->assertSession()->elementTextContains('css', '.block-localgov-guides nav', 'Blue Badges for organisations');
    $this->assertSession()->elementTextContains('css', '.block-localgov-guides nav', 'Apply for a Blue Badge');
    $this->assertSession()->elementTextContains('css', 'main article .callout-primary', 'Apply for a Blue Badge on GOV.UK');
    $this->assertSession()->elementTextContains('css', 'main article .alert-danger', 'Do not use unofficial sites which charge a fee for applying.');
    $this->assertSession()->elementTextContains('css', '.localgov_guides--navigation a', 'Previous');
    $this->assertSession()->elementTextContains('css', '.localgov_guides--navigation .localgov_guides--next', 'Next');

    // Test Step by step overview page: Request support for an adult.
    $this->drupalGet('/adult-health-and-social-care/step-by-step/request-support-adult-step-step');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Request support for an adult: step by step');
    $this->assertSession()->elementTextContains('css', 'main article .alert-info', 'Appointments with adult social care staff are now happening on the telephone.');
    $this->assertSession()->elementTextContains('css', 'main article .callout-danger', 'For urgent help');
    $this->assertSession()->elementTextContains('css', '.step-list', 'Find out what support we offer');
    $this->assertSession()->elementTextContains('css', '.step-list', 'Contact the support team');
    $this->assertSession()->elementTextContains('css', '.step-list', 'Apply for financial support');
    $this->assertSession()->elementTextContains('css', '.step-list', 'Choosing how to manage your care');

    // Test Step by step page: Find out what support we offer.
    $this->drupalGet('/adult-health-and-social-care/step-by-step/request-support-adult-step-step/find-out-what-support-we');
    $this->assertSession()->elementTextContains('css', 'header h1', 'Find out what support we offer');
    $this->assertSession()->elementTextContains('css', '.block-step-part-of-block', 'Part of Request support for an adult: step by step');
    $this->assertSession()->elementTextContains('css', '.region-content-bottom', 'Next step');
    $this->assertSession()->elementTextContains('css', 'main article h2', 'What we can help with');
    $this->assertSession()->elementTextContains('css', 'aside .step-list', 'Find out what support we offer');
    $this->assertSession()->elementTextContains('css', 'aside .step-list', 'See what social care is available, including:');
    $this->assertSession()->elementTextContains('css', 'aside .step-list', 'Contact the support team');
    $this->assertSession()->elementTextContains('css', 'aside .step-list', 'Apply for financial support');
    $this->assertSession()->elementTextContains('css', 'aside .step-list', 'Choosing how to manage your care');
  }

}
