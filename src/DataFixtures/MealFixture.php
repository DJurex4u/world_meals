<?php

namespace App\DataFixtures;

use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 *   It loads fake data into database
 *   command: php bin/console doctrine:fixtures:load
 *
 * Class MealFixture
 * @package App\DataFixtures
 */
class MealFixture extends Fixture
{
    const NUMBER_OF_OBJECTS = 20;
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NUMBER_OF_OBJECTS; $i++) {
            $j = $i + 1;  //I was too stupid to figure out why "$j = $i++" does not work as I expected, so yeah...
            $meal = new Meal();
            $meal->translate('hr')->setTitle('Naziv jela br.' . $j . ' na HRV jeziku');
            $meal->translate('hr')->setDescription('Opis jela br.' . $j .' na HRV jeziku');
            $meal->translate('de')->setTitle('Name des gerichts nummer '. $j .' auf Deutsch');
            $meal->translate('de')->setDescription( 'Beschreibung nummer'. $j .' auf Deutsch');
            $meal->translate('en')->setTitle('Title of a meal no.'. $j .'in English');
            $meal->translate('en')->setDescription('Description of a meal no.'. $j .' in English');

            $manager->persist($meal);
            $meal->mergeNewTranslations();
        }

        $manager->flush();
    }
}
