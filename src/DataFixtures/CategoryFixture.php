<?php


namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

const NUMBER_OF_CATEGORIES = 5;

class CategoryFixture extends Fixture
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
            $name = 'category'.$j;
            $this->addReference($name, $category);

            $manager->persist($category);
            $category->mergeNewTranslations();
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            Meal::class
        );
    }
}