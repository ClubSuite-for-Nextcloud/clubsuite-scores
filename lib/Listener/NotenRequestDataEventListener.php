<?php
namespace OCA\ClubSuiteScores\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteScores\Events\NotenRequestDataEvent;

class NotenRequestDataEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof NotenRequestDataEvent)) {
            return;
        }
        $data = ['app' => 'Noten', 'counts' => 0];
        $event->respond($data);
    }
}
