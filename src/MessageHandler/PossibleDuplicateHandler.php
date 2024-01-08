<?php

namespace App\MessageHandler;

use App\Entity\Fund;
use App\Message\PossibleDuplicate;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Psr\Log\LoggerInterface;


#[AsMessageHandler]
class PossibleDuplicateHandler {

    public function __construct(private LoggerInterface $logger, private ObjectManager $objectManager) {
    }

    public function __invoke(PossibleDuplicate $message) {
        $this->logger->info($message->getContent());
        $fundRepository = $this->objectManager->getRepository(Fund::class);
        $originalFund = $fundRepository->find($message->getFundId());

        $duplicates = $fundRepository
            ->findBy([
                'name' => $originalFund->getName()
            ],
            [
                "id" => "asc"
            ]);

        // This can hugely be improved upon
        $firstDuplicate = $duplicates[0];
        $originalFund->setDuplicateFund($firstDuplicate);

        // This will also set the ID of the first duplicate to itself so we know it has duplicates
        /** @var Fund $duplicate */
        foreach ($duplicates as $duplicate){
            $duplicate->setDuplicateFund($firstDuplicate);
            $this->objectManager->persist($duplicate);
        }

        $this->objectManager->flush();
    }
}