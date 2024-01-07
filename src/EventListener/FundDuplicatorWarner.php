<?php

// src/EventListener/UserChangedNotifier.php
namespace App\EventListener;

use App\Entity\Fund;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Fund::class)]
class FundDuplicatorWarner {

    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function postPersist(Fund $fund, PostPersistEventArgs $event): void {
        dump($fund->getName());
    }
}