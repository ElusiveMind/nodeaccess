<?php

namespace Drupal\nodeaccess\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * A method of removing a user's assigned permissions from a piece of
 * content. No confirmation dialogue yet. That is on the list.
 */
class RemoveUser extends ControllerBase {

  /**
   * Handler for permission by account removal.
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