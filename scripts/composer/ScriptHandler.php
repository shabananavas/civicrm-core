<?php

/**
 * @file
 * Contains \CiviCRMCore\composer\ScriptHandler.
 */

namespace CiviCRMCore\composer;

use Composer\Script\Event;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ScriptHandler.
 *
 * @package CiviCRMCore\composer
 */
class ScriptHandler {

  /**
   * Download CiviCRM assets and copy the required assets to the libraries dir.
   *
   * @param \Composer\Script\Event $event
   *   The script event.
   */
  public static function createRequiredAssets(Event $event) {
    $fs = new Filesystem();
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(getcwd());
    $drupalRoot = $drupalFinder->getDrupalRoot();

    // Prepare the settings directory for CiviCRM installation.
    $fs->chmod($drupalRoot . '/sites/default', 0775);

    // Create a libraries folder if it doesn't exist.
    $dir = 'libraries';
    if (!$fs->exists($drupalRoot . '/' . $dir)) {
      $fs->mkdir($drupalRoot . '/' . $dir);
    }

    // Run bower install and copy the necessary assets to the libraries folder.
    $current_dir = getcwd();
    $libraries_dir = $drupalRoot . '/' . $dir;

    escapeshellarg($current_dir);
    escapeshellarg($libraries_dir);
    $output = shell_exec("sh $current_dir/civicrm-drupal-post-install.sh $current_dir $libraries_dir");
  }

}
