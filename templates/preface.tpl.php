<?php

/**
 * @file
 * Default theme implementation to display a preface for the current page.
 */

print $breadcrumb;
if ($title) {
  print render($title_prefix);
  print '<h1>' . $title . '</h1>';
  print render($title_suffix);
}
print $messages;
print render($help);
print render($tabs);
if ($actions) {
  print '<ul class="action-links">' . render($actions) . '</ul>';
}