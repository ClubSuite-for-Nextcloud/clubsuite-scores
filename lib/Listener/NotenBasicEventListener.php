<?php
namespace OCA\ClubSuiteScores\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteScores\Events\NotenBasicEvent;

class NotenBasicEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof NotenBasicEvent)) {
            return;
        }
        error_log('NotenBasicEvent received in Noten: ' . $event->getId());
    }
}
