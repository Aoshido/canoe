<?php

namespace App\MessageHandler;

use App\Message\PossibleDuplicate;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PossibleDuplicateHandler {
    public function __invoke(PossibleDuplicate $message) {
        // ... do some work - like sending an SMS message!
    }
}