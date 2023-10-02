<?php

namespace Drupal\some_block\Controller;

use Drupal\examples\Utility\DescriptionTemplateTrait;


class BlockSomeBlockController {
  use DescriptionTemplateTrait;

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'some_block';
  }

}

