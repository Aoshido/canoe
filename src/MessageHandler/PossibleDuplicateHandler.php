<?php

namespace App\MessageHandler;

use App\Message\PossibleDuplicate;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Psr\Log\LoggerInterface;

#[AsMessageHandler]
class PossibleDuplicateHandler {

    public function __construct(private LoggerInterface $logger) {
    }

    public function __invoke(PossibleDuplicate $message) {
        $this->logger->info($message->getContent());
    }
}