<?php

namespace Drupal\localgov_login_redirect\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\PathValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Login redirect settings for class.
 */
class LoginRedirectSettingsForm extends ConfigFormBase {

  /**
   * The path validator.
   *
   * @var \Drupal\Core\Path\PathValidator
   */
  protected PathValidator $pathValidator;

  /**
   * Constructs a new UserRedirectSettingsForm.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\Core\Path\PathValidator $path_validator
   *   The route provider.
   */
  public function __construct(ConfigFactoryInterface $config_factory, PathValidator $path_validator) {
    parent::__construct($config_factory);
    $this->pathValidator = $path_validator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('path.validator')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'localgov_login_redirect_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['localgov_login_redirect.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    $config = $this->config('localgov_login_redirect.settings');

    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable login redirect'),
      '#description' => $this->t('Redirect users to the content overview page at login.'),
      '#default_value' => $config->get('enabled'),
    ];
    $form['redirect_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('User redirect path'),
      '#description' => $this->t('The Drupal path name to redirect users to once logged in.'),
      '#default_value' => $config->get('redirect_path'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $redirect_path = $form_state->getValue('redirect_path');
    if (!empty($redirect_path) and !$this->pathValidator->isValid($redirect_path)) {
      $form_state->setErrorByName('redirect_path', 'Redirect path is invalid.');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->config('localgov_login_redirect.settings');
    $config->set('enabled', $form_state->getValue('enabled') === 1);
    $config->set('redirect_path', $form_state->getValue('redirect_path'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
