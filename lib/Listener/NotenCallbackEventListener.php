<?php
namespace OCA\ClubSuiteScores\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteScores\Events\NotenCallbackEvent;

class NotenCallbackEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof NotenCallbackEvent)) {
            return;
        }
        $payload = $event->getPayload();
        $event->triggerCallback(['handledBy' => 'Noten', 'items' => count($payload)]);
    }
}
