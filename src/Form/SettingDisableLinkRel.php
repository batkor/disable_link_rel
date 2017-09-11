<?php

namespace Drupal\disable_link_rel\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class ImportContactForm.
 *
 * @package Drupal\module_import_contacts\Form
 */
class SettingDisableLinkRel extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['disable_link_rel.import'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'disable_link_rel_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('disable_link_rel.import');

    $form['enable'] = [
      '#title'         => 'Удалить rel ссылки с раздела head',
      '#type'          => 'checkbox',
      '#default_value' => $config->get('enable') ? $config->get('enable') : NULL,
    ];

    $form['links'] = [
      '#title'         => 'Введите значения атрибута для удаления',
      '#type'          => 'textfield',
      '#default_value' => $config->get('links') ? $config->get('links') : '',
      '#description' => 'Введите атрибуты через запятую. Например: <i>canonical, shortlink, delete-form</i>'
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->config('disable_link_rel.import');
    $config->set('enable', $form_state->getValue('enable'));
    $config->set('links', $form_state->getValue('links'));
    $config->save();
  }
}