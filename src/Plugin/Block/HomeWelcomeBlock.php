<?php

namespace Drupal\localgov\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a home page welcome block.
 *
 * @Block(
 *   id = "localgov_home_welcome_block",
 *   admin_label = @Translation("Home welcome block")
 * )
 */
class HomeWelcomeBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->getConfiguration();

    if (!empty($config['localgov_home_welcome_message'])) {
      $message = $config['localgov_home_welcome_message']['value'];
    }
    else {
      $message = $this->t('<h2>You have just installed a LocalGov Drupal site</h2>');
    }

    return [
      '#markup' => $message,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['localgov_home_welcome_message'] = [
      '#type' => 'text_format',
      '#format' => 'wysiwyg',
      '#title' => $this->t('Welcome message'),
      '#description' => $this->t('Site installation welcome message'),
      '#default_value' => isset($config['localgov_home_welcome_message']) ? $config['localgov_home_welcome_message']['value'] : '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['localgov_home_welcome_message'] = $form_state->getValue('localgov_home_welcome_message');
  }

}
