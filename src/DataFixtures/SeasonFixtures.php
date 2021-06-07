<?php

namespace App\DataFixtures;


use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture  implements DependentFixtureInterface
{
    const SEASONS = [
        "1",
        "2",
        "3",
        "4",
        "5"
    ];
    public function load(ObjectManager $manager)
    {

        foreach (self::SEASONS as $key => $seasonName) {
            $season = new Season();
            $season->setNumber($seasonName);
            $season->setYear(1945 + $key);
            $season->setDescription("lorem ipsum dolor est");
            $this->addReference('season_' . $key, $season);
            $season->setProgram($this->getReference('program_0'));
            $manager->persist( $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
