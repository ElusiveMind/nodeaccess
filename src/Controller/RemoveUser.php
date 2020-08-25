<?php

namespace Drupal\nodeaccess\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Defines a route controller for watches autocomplete form elements.
 */
class RemoveUser extends ControllerBase {

  /**
   * Handler for autocomplete request.
   */
  public function handleRemoval($nid, $uid) {
    $db = \Drupal::database();

    $delete = $query = $db->delete('nodeaccess')
      ->condition('nid', $nid)
      ->condition('gid', $uid)
      ->condition('realm', 'nodeaccess_uid')
      ->execute();

    \Drupal::messenger()->addMessage(t('The selected user was removed. No other data was saved.'));
    return new RedirectResponse('/node/' . $nid . '/edit'); 
  }
}