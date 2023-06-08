<?php

namespace Drupal\localgov_login_redirect\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

/**
 * Login redirect settings for class.
 */
class LoginRedirectSettingsForm extends ConfigFormBase {

  /**
   * The route provider.
   *
   * @var \Drupal\Core\Routing\RouteProvider
   */
  protected RouteProvider $routeProvider;

  /**
   * Constructs a new UserRedirectSettingsForm.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\Core\Routing\RouteProvider $route_provider
   *   The route provider.
   */
  public function __construct(ConfigFactoryInterface $config_factory, RouteProvider $route_provider) {
    parent::__construct($config_factory);
    $this->routeProvider = $route_provider;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('router.route_provider')
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
    $form['redirect_route'] = [
      '#type' => 'textfield',
      '#title' => $this->t('User redirect route'),
      '#description' => $this->t('The Drupal route name to redirect users to once logged in. This is <strong>not</strong> the path to a page.'),
      '#default_value' => $config->get('redirect_route'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $redirect_route = $form_state->getValue('redirect_route');
    if (!empty($redirect_route)) {
      try {
        $this->routeProvider->getRouteByName($redirect_route);
      }
      catch (RouteNotFoundException $exception) {
        $form_state->setErrorByName('redirect_route', 'Redirect route is invalid.');
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->config('localgov_login_redirect.settings');
    $config->set('enabled', $form_state->getValue('enabled') === 1);
    $config->set('redirect_route', $form_state->getValue('redirect_route'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
