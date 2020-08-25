<?php

namespace Drupal\nodeaccess\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Xss;

/**
 * Defines a route controller for watches autocomplete form elements.
 */
class UserAutocompleteController extends ControllerBase {

  /**
   * Handler for autocomplete request.
   */
  public function handleAutocomplete(Request $request) {
    $results = [];
    $input = $request->query->get('q');
    $db = \Drupal::database();

    // Get the typed string from the URL, if it exists.
    if (!$input) {
      return new JsonResponse($results);
    }

    $input = Xss::filter($input);

    $query = $db->select('users_field_data', 'ufd')
      ->fields('ufd', ['uid', 'name'])
      ->condition('name', "%" . $input . "%", 'LIKE')
      ->orderBy('name', 'ASC')
      ->range(0, 10)
      ->execute();
    $ids = $query->fetchAll();

    foreach ($ids as $user) {
      $results[] = [
        'label' => $user->name,
        'value' => $user->name . ' [' . $user->uid . ']',
      ];
    }

    return new JsonResponse($results);
  }
}