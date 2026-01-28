<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\AppInfo;

use OCA\ClubSuiteScores\Privacy\Register;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\IContainer;
use OCA\ClubSuiteScores\Service\CacheService;
use OCA\ClubSuiteScores\Service\EventService;
use OCA\ClubSuiteScores\Listener\NotenBasicEventListener;
use OCA\ClubSuiteScores\Listener\NotenCallbackEventListener;
use OCA\ClubSuiteScores\Listener\NotenRequestDataEventListener;
use OCA\ClubSuiteScores\Events\NotenBasicEvent;
use OCA\ClubSuiteScores\Events\NotenCallbackEvent;
use OCA\ClubSuiteScores\Events\NotenRequestDataEvent;

if (!\class_exists('OCA\ClubSuiteScores\AppInfo\Application', false)) {
class Application extends App implements IBootstrap {
    public const APP_ID = 'clubsuite-scores';

    public function __construct(array $urlParams = []) {
        parent::__construct(self::APP_ID, $urlParams);
        $container = $this->getContainer();
        $container->registerService('CacheService', function(IContainer $c){ return new CacheService($c->query('ICache')); });
        $container->registerService('EventService', function(IContainer $c){ return new EventService(\OC::$server->getEventDispatcher()); });
    }

    public function register(IRegistrationContext $context): void {
        $context->registerEventListener(NotenBasicEvent::class, NotenBasicEventListener::class);
        $context->registerEventListener(NotenCallbackEvent::class, NotenCallbackEventListener::class);
        $context->registerEventListener(NotenRequestDataEvent::class, NotenRequestDataEventListener::class);
    }

    public function boot(IBootContext $context): void {
        $context->injectFn(function(\OCP\IContainer $c) {
            if (\interface_exists('\OCP\Privacy\IManager')) {
                $c->get(\OCP\Privacy\IManager::class)->registerProvider(Register::class);
            }
        });
    }
}

}
