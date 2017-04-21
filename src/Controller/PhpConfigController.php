<?php
/**
 * Created by PhpStorm.
 * User: bappasarkar
 * Date: 20/04/17
 * Time: 11:16 PM
 */

/**
@file
Contains \Drupal\phpconfig\Controller\PhpConfigController.
 */

namespace Drupal\phpconfig\Controller;

use Drupal\Core\Controller\ControllerBase;

class PhpConfigController extends ControllerBase {
    public function content() {
        return array(
            '#type' => 'markup',
            '#markup' => t('Hello world'),
        );
    }
}