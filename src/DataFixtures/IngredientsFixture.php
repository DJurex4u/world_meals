<?php


namespace App\DataFixtures;


use App\Entity\Ingredient;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

const NUMBER_OF_INGREDIENTS = 50;

class IngredientsFixture extends Fixture
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
            $name = 'ingredient'.$j;
            $this->addReference($name, $ingredient);

            $manager->persist($ingredient);
            $ingredient->mergeNewTranslations();
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            Meal::class
        );
    }

}