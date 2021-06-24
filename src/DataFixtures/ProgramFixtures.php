<?php

namespace App\DataFixtures;

use App\Service\Slugify;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        "  Bill  contre les 123%/é'(-è chats-garoux",
        "Manu et le mystère de la tomate bleu",
        "Josef et ses dix frère",
        "Qui as mangé Marie?",
        "nom de code: miam"

        ];
    private $slug;

    public function __construct(Slugify $slug)
    {
        $this->slug = $slug;
    }
    public function load(ObjectManager $manager)
    {

        foreach (self::PROGRAMS as $key => $programName) {
            $program = new Program();
            $program->setTitle($programName);
            $slug = $this->slug->generate($programName);
            $program->setSlug($slug);
            $program->setOwner(1);
            $program->setSummary('lorem ipsum dolor est');
            $program->setCategory($this->getReference('category_0'));
            $this->addReference('program_' . $key, $program);
            //ici les acteurs sont insérés via une boucle pour être DRY mais ce n'est pas obligatoire
            for ($i = 0; $i < count(ActorFixtures::ACTORS); $i++) {
                $program->addActor($this->getReference('actor_' . $i));
            }
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ActorFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
