<?php
namespace OCA\FunkwhaleSync\Listener;

use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\Files\Events\Node\{AbstractNodeEvent,
    AbstractNodesEvent,
    NodeCopiedEvent,
    NodeCreatedEvent,
    NodeDeletedEvent,
    NodeRenamedEvent,
    NodeTouchedEvent,
    NodeWrittenEvent};
use Psr\Log\LoggerInterface;

class MusicLibraryListener implements IEventListener {
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function handle(Event $event): void {
        $this->logger->error(get_class($event));
        if ($event instanceof AbstractNodeEvent) {
            $this->handleNodeEvent($event);
        } elseif ($event instanceof AbstractNodesEvent) {
            $this->handleNodesEvent($event);
        } else {
            return;
        }
        // if the node is in the same path as your library, then do an API request based on it.
    }

    private function handleNodeEvent(AbstractNodeEvent $event): void {
        $class = get_class($event);
        $node = $event->getNode();
        $this->logger->error($node->getName());
        $this->logger->error($node->getPath());
        switch($class) {
            case NodeCreatedEvent::class:
                $this->logger->error("Created!");
                break;
            case NodeDeletedEvent::class:
                $this->logger->error("Deleted!");
                break;
            case NodeTouchedEvent::class:
                $this->logger->error("Touched!");
                break;
            case NodeWrittenEvent::class:
                $this->logger->error("Written!");
                break;
        }
    }

    private function handleNodesEvent(AbstractNodesEvent $event): void {
        $class = get_class($event);
        $source = $event->getSource();
        $target = $event->getTarget();
        $this->logger->error($source->getName());
        $this->logger->error($source->getPath());
        $this->logger->error($target->getName());
        $this->logger->error($target->getPath());
        switch($class) {
            case NodeCopiedEvent::class:
                $this->logger->error("Copied!");
                break;
            case NodeRenamedEvent::class:
                $this->logger->error("Renamed!");
                break;

        }
    }
}
