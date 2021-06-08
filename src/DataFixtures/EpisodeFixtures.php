<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        "la migale et les loups gris",
        "L'homme aux dix dents",
        "L'homme aux 3 dents",
        "L'homme sans dents",
        "un sourire malgré moi"
    ];

    private $slug;

    public function __construct(Slugify $slug)
    {
        $this->slug = $slug;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $key => $episodeName)
        {
            $episode = new Episode();
            $episode->setTitle($episodeName);
            $slug = $this->slug->generate($episodeName);
            $episode->setSlug($slug);
            $episode->setSynopsis('lorem ipsum dolor est');
            $episode->setSeason($this->getReference('season_0'));

                $episode->setNumber($key + 1);

                //ici les acteurs sont insérés via une boucle pour être DRY mais ce n'est pas obligatoire

            $manager->persist($episode);

        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
