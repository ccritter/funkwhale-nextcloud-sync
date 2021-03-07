<?php
namespace OCA\FunkwhaleSync\AppInfo;

use OCA\FunkwhaleSync\Listener\MusicLibraryListener;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\EventDispatcher\IEventDispatcher;
use OCP\Files\Events\Node\{
    NodeCopiedEvent,
    NodeCreatedEvent,
    NodeDeletedEvent,
    NodeRenamedEvent,
    NodeTouchedEvent,
    NodeWrittenEvent
};

class Application extends App implements IBootstrap {

    public function __construct() {
        parent::__construct('funkwhalesync');
    }


    public function register(IRegistrationContext $context): void {
        $eventClasses = array(
            NodeCopiedEvent::class,
            NodeCreatedEvent::class,
            NodeDeletedEvent::class,
            NodeRenamedEvent::class,
            NodeTouchedEvent::class,
            NodeWrittenEvent::class
        );
        foreach ($eventClasses as $eventClass) {
            $context->registerEventListener($eventClass, MusicLibraryListener::class);
        }
    }

    public function boot(IBootContext $context): void {
    }
}