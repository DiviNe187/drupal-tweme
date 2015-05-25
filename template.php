<?php

/**
 * Implements hook_html_head_alter().
 */
function tweme_html_head_alter(&$head_elements) {
  foreach ($head_elements as &$element) {
    if (isset($element['#attributes']['rel'])
        && in_array($element['#attributes']['rel'], array('canonical', 'shortlink'))
        && drupal_is_front_page()) {
      $element['#attributes']['href'] = '/';
    }
  }
}

/**
 * Implements hook_css_alter().
 */
function tweme_css_alter(&$css) {
  unset($css['modules/poll/poll.css']);
}

/**
 * Preprocesses variables for block.tpl.php.
 */
function tweme_preprocess_block(&$vars) {
  $block = $vars['block'];

  if ($block->region == 'header' && $block->module == 'imageblock' && module_exists('imageblock')) {
    if ($img = imageblock_get_file($block->delta)) {
      $src = file_create_url($img->uri);
      $vars['attributes_array']['style'] = sprintf('background-image: url(%s)', $src);
    }
  }
}

/**
 * Preprocesses variables for entity.tpl.php.
 */
function tweme_preprocess_entity(&$vars) {
  $element = $vars['elements'];

  if ($element['#entity_type'] == 'atom') {
    if (!empty($element['#host_field']) && $element['#host_field'] == 'field_featured' && $element['#bundle'] == 'container') {
      $vars['classes_array'][] = 'header-body';
    }
  }
}
