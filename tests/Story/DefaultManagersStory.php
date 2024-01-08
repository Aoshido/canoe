<?php

namespace App\Tests\Story;

use App\Tests\Factory\ManagerFactory;
use Zenstruck\Foundry\Story;

final class DefaultManagersStory extends Story {
    public function build(): void {
        ManagerFactory::createMany(100);
    }
}
