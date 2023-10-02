<?php

namespace Drupal\welcome_user\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Welcome' Block.
 *
 * @Block(
 *   id = "welcome_block",
 *   admin_label = @Translation("Some sort of Block for welcoming the user"),
 *   category = @Translation("Description for this block"),
 *   cache_contexts = {
 *     "cache.context.config:welcome_user.settings"
 *   }
 * )
 */
class WelcomeBlock extends BlockBase implements ContainerFactoryPluginInterface{
  /// Why deleting implements ContainerFactoryPluginInterface breaks the code?

  /**
   * @var ConfigFactoryInterface
   */
  protected ConfigFactoryInterface $configDI;

  /**
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param ConfigFactoryInterface $config_factory_interface
   */
  function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory_interface)
  {
    $this->configDI = $config_factory_interface;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration, $plugin_id, $plugin_definition,
      $container->get("config.factory"),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t(\Drupal::config("welcome_user.settings")->get("welcome_message")),
      '#cache' => [
        'tags'=> $this->configDI->get('welcome_user.settings')->getCacheTags(),
      ],
    ];
  }

}
