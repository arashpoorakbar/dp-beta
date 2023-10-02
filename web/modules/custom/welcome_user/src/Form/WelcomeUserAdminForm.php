<?php

declare(strict_types=1);

namespace Drupal\welcome_user\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

final class WelcomeUserAdminForm extends ConfigFormBase {

  /**
   * {@inheritDoc}
   */
  protected function getEditableConfigNames()
  {
    return ["welcome_user.settings"];
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId()
  {
    return "welcome_user_admin_configuration_form";
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form["welcome_message"] = [
      '#type' => 'textfield',
      '#title' => $this->t("Some Welcome Message Goes Here"),
      '#default_value' => $this->config("welcome_user.settings")->get("welcome_message")
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config("welcome_user.settings")
      ->set("welcome_message",$form_state->getValue("welcome_message"))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
