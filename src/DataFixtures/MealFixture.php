<?php

namespace App\DataFixtures;

use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 *   It loads fake data into database
 *   command: php bin/console doctrine:fixtures:load
 *
 * Class MealFixture
 * @package App\DataFixtures
 */
const NUMBER_OF_MEALS = 20;

class MealFixture extends Fixture //implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < NUMBER_OF_MEALS; $i++) {
            $j = $i + 1;
            $meal = new Meal();
            $meal->translate('hr')->setTitle('Naziv jela br.' . $j . ' na HRV jeziku');
            $meal->translate('hr')->setDescription('Opis jela br.' . $j .' na HRV jeziku');
            $meal->translate('de')->setTitle('Name des gerichts nummer '. $j .' auf Deutsch');
            $meal->translate('de')->setDescription( 'Beschreibung nummer'. $j .' auf Deutsch');
            $meal->translate('en')->setTitle('Title of a meal no.'. $j .' in English');
            $meal->translate('en')->setDescription('Description of a meal no.'. $j .' in English');

            $name = 'meal'.$j;
            $this->addReference($name, $meal);

            $manager->persist($meal);
            $meal->mergeNewTranslations();
        }

        $manager->flush();
    }
}
