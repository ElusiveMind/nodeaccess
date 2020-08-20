<?php

namespace Drupal\nodeaccess\AccessChecks;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * A custom access check for grants form.
 */
class NodeGrantAccessCheck implements AccessInterface {

  /**
   * A custom access check.
   */
  public function access($node, AccountInterface $account) {

    if (!$node) {
      return AccessResult::forbidden();
    }
    $nid = $node;
    $node = Node::load($nid);
    $bundle = $node->getType();
    $user = \Drupal::currentUser();

    $interface =  NodeType::load($bundle);
    $enabled = $interface->getThirdPartySetting('nodeaccess', 'nodeaccess_grant_tab_' . $bundle, FALSE);

    if (!empty($enabled) && ($user->hasPermission('grant node view') || $user->hasPermission('grant node update') || $user->hasPermission('grant node delete'))) {
      return AccessResult::Allowed();
    }
    else {
      return AccessResult::forbidden();
    }
  }

}
