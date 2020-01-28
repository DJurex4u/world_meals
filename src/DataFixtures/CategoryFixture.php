<?php


namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

const NUMBER_OF_CATEGORIES = 5;

class CategoryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < NUMBER_OF_CATEGORIES; $i++) {
            $category = new Category();
            $j = $i + 1;
            $category->translate('hr')->setTitle('Kategorija '.$j.' na HRV jeziku');
            $category->translate('de')->setTitle('Kategorie '.$j.' auf Deutsch');
            $category->translate('en')->setTitle('Category no. '.$j.' in ENG');
            $category->setSlug('category'.$j);  //there are bundles, but not for symfony 5 :(

            // meal - category
            $randInt = mt_rand(1, NUMBER_OF_MEALS - 1);
            $meal = $this->getReference('meal'.$randInt);
            if (!$meal->getCategory()){
                $category->setMeal($meal);
            }

            $manager->persist($category);
            $category->mergeNewTranslations();
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            MealFixture::class
        );
    }
}