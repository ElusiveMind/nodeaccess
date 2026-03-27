# Nodeaccess - Per Node Access Management for Drupal 11

## Introduction

This module allows you to manage permissions for individual nodes by role and
user. You can restrict access to any node without having to use taxonomy by
assigning view, edit, or delete permissions per node to specific roles or users.

Grants are configured directly on the node add/edit form rather than on a
separate tab. Default grants are defined per content type on each content type's
edit page.

## Requirements

- Drupal 11
- PHP 8.3+

## Installation

Install via Composer:

```
composer require mbagnall/nodeaccess
```

Then enable the module:

```
drush en nodeaccess
```

> **Note:** This package conflicts with `drupal/nodeaccess` (the legacy
> Drupal.org version). You cannot have both installed at the same time.

## Configuration

1. **Enable per content type:** Go to **Administration > Structure > Content
   types**, edit a content type, and check "Show grant tab for this node type"
   under the Nodeaccess section. Set default role permissions for view, edit, and
   delete here as well.

2. **Assign role visibility:** Go to **Administration > People > Permissions**
   and grant the "Include in Nodeaccess grants" permission to roles that should
   appear in per-node grant forms. If the "Authenticated user" role has this
   permission, all non-anonymous roles are automatically included.

3. **Per-node grants:** When creating or editing a node (for an enabled content
   type), expand the Nodeaccess section, check "Engage nodeaccess control for
   this node", and set role and user-specific permissions.

4. **Admin page:** Visit **Administration > Structure > Nodeaccess** to view or
   rebuild the role-to-grant-ID mapping.

## Permissions

| Permission | Description |
|---|---|
| Administer Nodeaccess | Access the Nodeaccess administration pages (restricted) |
| Grant Node Permissions | Allow granting permissions on individual nodes |
| Include in Nodeaccess grants | Determines if a role appears in per-node grant forms |

## Testing

PHPUnit tests are located in `tests/src/`. To run them from the Drupal root:

```
vendor/bin/phpunit web/modules/drupal/nodeaccess/tests/
```

Kernel tests cover grant records, access checks, role map management, and
installation. Functional tests cover the admin configuration form and node form
integration.

## Links

- [GitHub repository](https://github.com/ElusiveMind/nodeaccess) (pull requests)
- [Issue queue](https://github.com/ElusiveMind/nodeaccess/issues) (bugs, feature requests)
