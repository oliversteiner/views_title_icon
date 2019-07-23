<?php
/**
 * @file
 * Contains \Drupal\views_title_icon\Plugin\views\display_extender\TitleIcon.
 *
 * http://blog.studio.gd/node/17
 */

namespace Drupal\views_title_icon\Plugin\views\display_extender;

use Drupal\views\Plugin\views\display_extender\DisplayExtenderPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Title icon display extender plugin.
 *
 * @ingroup views_display_extender_plugins
 *
 * @ViewsDisplayExtender(
 *   id = "title_icon",
 *   title = @Translation("title icon display extender"),
 *   help = @Translation("Settings to add an icon to the views title."),
 *   no_ui = FALSE
 * )
 */
class TitleIcon extends DisplayExtenderPluginBase
{
  /**
   * Provide the key options for this plugin.
   */
  public function defineOptionsAlter(&$options)
  {
    $options['title_icon'] = array(
      'contains' => array(
        'icon_name' => array('default' => ''),
      )
    );
  }

  /**
   * Provide the default summary for options and category in the views UI.
   */
  public function optionsSummary(&$categories, &$options)
  {
    $categories['title_icon'] = array(
      'title' => t('Icon'),
      'column' => 'second',
    );
    $title_icon = $this->hasIcon() ? $this->getIconValues() : FALSE;
    $options['title_icon'] = array(
      'category' => 'title_icon',
      'title' => t('Icon'),
      'value' => $title_icon ? $title_icon['icon_name'] : $this->t('none'),
    );
  }

  /**
   * Provide a form to edit options for this plugin.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state)
  {
    if ($form_state->get('section') == 'title_icon') {
      $form['#title'] .= t('Icon name');
      $title_icon = $this->getIconValues();
      $form['title_icon']['#type'] = 'container';
      $form['title_icon']['#tree'] = TRUE;
      $form['title_icon']['icon_name'] = array(
        '#title' => $this->t('Icon'),
        '#type' => 'textfield',
        '#description' => $this->t('Icon name with prefix (fas fa-NAME)'),
        '#default_value' => $title_icon['icon_name'],
      );

    }
  }

  /**
   * Validate the options form.
   */
  public function validateOptionsForm(&$form, FormStateInterface $form_state)
  {
  }

  /**
   * Handle any special handling on the validate form.
   */
  public function submitOptionsForm(&$form, FormStateInterface $form_state)
  {
    if ($form_state->get('section') == 'title_icon') {
      $title_icon = $form_state->getValue('title_icon');
      $this->options['title_icon'] = $title_icon;
    }
  }

  /**
   * Set up any variables on the view prior to execution.
   */
  public function preExecute()
  {
  }

  /**
   * Inject anything into the query that the display_extender handler needs.
   */
  public function query()
  {
  }

  /**
   * Static member function to list which sections are defaultable
   * and what items each section contains.
   */
  public function defaultableSections(&$sections, $section = NULL)
  {
  }

  /**
   * Identify whether or not the current display has custom metadata defined.
   */
  public function hasIcon()
  {
    $title_icon = $this->getIconValues();
    return !empty($title_icon['icon_name']);
  }

  /**
   * Get the title icon configuration for this display.
   *
   * @return array
   *   The title icon values.
   */
  public function getIconValues()
  {
    if ($this->options && $this->options['title_icon']) {
      $title_icon = $this->options['title_icon'];
      return $title_icon;
    } else {
      return '';
    }

  }
}
