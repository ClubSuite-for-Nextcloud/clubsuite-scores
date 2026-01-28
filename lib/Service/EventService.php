<?php
namespace OCA\ClubSuiteScores\Service;

use OCP\EventDispatcher\IEventDispatcher;
use OCA\ClubSuiteScores\Events\NotenBasicEvent;
use OCA\ClubSuiteScores\Events\NotenCallbackEvent;
use OCA\ClubSuiteScores\Events\NotenRequestDataEvent;

class EventService {
    private IEventDispatcher $dispatcher;

    public function __construct(IEventDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function dispatchBasicEvent(array $payload): void {
        $event = new NotenBasicEvent(uniqid('noten_', true), time(), $payload);
        $this->dispatcher->dispatch($event);
    }

    public function dispatchCallbackEvent(array $payload, callable $callback): void {
        $event = new NotenCallbackEvent(uniqid('noten_cb_', true), time(), $payload, $callback);
        $this->dispatcher->dispatch($event);
    }

    public function dispatchRequestDataEvent(callable $callback): void {
        $event = new NotenRequestDataEvent(uniqid('noten_req_', true), time(), [], $callback);
        $this->dispatcher->dispatch($event);
    }
}
