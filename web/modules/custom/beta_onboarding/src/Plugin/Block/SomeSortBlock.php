<?php

namespace Drupal\beta_onboarding\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\Factory\ContainerFactory;
use League\Container\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Welcome' Block.
 *
 * @Block(
 *   id = "welcome_block",
 *   admin_label = @Translation("Some sort of Block for welcoming the user"),
 *   category = @Translation("Description for this block"),
 *   cache_contexts = {
 *     "cache.context.config:beta_onboarding.settings"
 *   }
 * )
 */
class SomeSortBlock extends BlockBase implements ContainerFactoryPluginInterface{
  /// Why deleting implements ContainerFactoryPluginInterface breaks the code?
  protected ConfigFactoryInterface $alaki;
  function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $sth)
  {

    $this->alaki = $sth;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

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
  $cache_tags = \Drupal::config('beta_onboarding.settings')->getCacheTags();
  echo($this->alaki->get("beta_onboarding.settings")->get("welcome_message"));
  var_dump($cache_tags);

    return [
      '#markup' => $this->t(\Drupal::config("beta_onboarding.settings")->get("welcome_message")),
      '#cache' => [
        'tags'=> $cache_tags,
      ],
    ];
  }

}
