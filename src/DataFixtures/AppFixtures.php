<?php

namespace App\DataFixtures;

use App\Tests\Story\DefaultFundsStory;
use App\Tests\Story\DefaultManagersStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultFundsStory::load();
        DefaultManagersStory::load();
    }
}
