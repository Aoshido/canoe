<?php

// src/EventListener/UserChangedNotifier.php
namespace App\EventListener;

use App\Entity\Fund;
use App\Message\PossibleDuplicate;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Fund::class)]
class FundDuplicatorWarner {

    // Inject the MessageBusInterface through the constructor
    public function __construct(private MessageBusInterface $bus) {
    }

    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function postPersist(Fund $fund, PostPersistEventArgs $event): void {
        $this->bus->dispatch(new PossibleDuplicate('Look! I created a message!'));
    }
}