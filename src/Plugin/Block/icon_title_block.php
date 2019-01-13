<?php

namespace Drupal\views_title_icon\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'icon_title_block' block.
 *
 * @Block(
 *  id = "icon_title_block",
 *  admin_label = @Translation("Icon Title block"),
 * )
 */
class icon_title_block extends BlockBase
{

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration()
    {
        return [
            ] + parent::defaultConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form['inputtext'] = [
            '#type' => 'text_format',
            '#title' => $this->t('InputText'),
            '#description' => $this->t('Just an input text'),
            '#default_value' => $this->configuration['inputtext'],
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state)
    {
        $this->configuration['inputtext'] = $form_state->getValue('inputtext');
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {

        return array(
            '#theme' => 'views_title_icon',
            '#cache' => ['max-age' => 30],
            'content' => []

        );
    }
}