<?php
/**
 * Created by PhpStorm.
 * User: bappasarkar
 * Date: 4/24/17
 * Time: 1:33 PM
 */


namespace Drupal\phpconfig\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Url;

/**
 * Applying all enabled PHP configurations.
 */
class ApplyConfig implements EventSubscriberInterface {
  /**
   * Apply all PHP configs.
   * @param GetResponseEvent $event
   */
  public function PHPConfigLoad(GetResponseEvent $event) {
    // Applying all enabled PHP configurations.
    $handler = db_query("SELECT item, value FROM {phpconfig_items} WHERE status = 1");
    if ($handler) {
      while ($value = $handler->fetchObject()) {
        ini_set($value->item, $value->value);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('PHPConfigLoad');
    return $events;
  }
}