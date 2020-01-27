<?php


namespace App\DataFixtures;


use App\Entity\Ingredient;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

const NUMBER_OF_INGREDIENTS = 25;

class IngredientsFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < NUMBER_OF_INGREDIENTS; $i++) {
            $ingredient = new Ingredient();
            $j = $i + 1;
            $ingredient->translate('hr')->setTitle('Sastojak '.$j.' na HRV jeziku');
            $ingredient->translate('de')->setTitle('Zutat '.$j.' auf Deutsch');
            $ingredient->translate('en')->setTitle('Ingredient no. '.$j.' in ENG');
            $ingredient->setSlug('ingridient'.$j);  //there are bundles, but not for symfony 5 :(

            $randInt = mt_rand(1, NUMBER_OF_MEALS - 1);
            $meal = $this->getReference('meal'.$randInt);
            $ingredient->setMeal($meal);

            $manager->persist($ingredient);
            $ingredient->mergeNewTranslations();
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            MealFixture::class
        );
    }

}