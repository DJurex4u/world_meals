<?php


namespace App\DataFixtures;


use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

const NUMBER_OF_TAGS = 10;
class TagFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < NUMBER_OF_TAGS; $i++){
            $tag = new Tag();
            $j = $i + 1;
            $tag->translate('hr')->setTitle('Tag '.$j.' na HRV jeziku');
            $tag->translate('de')->setTitle('Tag '.$j.' auf Deutsch');
            $tag->translate('en')->setTitle('Tag '.$j.' in English');
            $tag->setSlug('tag'.$j);


            // meal - tag
            if($j < NUMBER_OF_MEALS + 1)
            {
                $meal = $this->getReference('meal'.$j);
                $tag->setMeal($meal);
            }
            $randNum = mt_rand(0,3);
            for ($k = 0; $k < $randNum; $k++) {
                $randMeal = mt_rand(1, NUMBER_OF_MEALS - 1);
                $meal = $this->getReference('meal' . $randMeal);
                $tag->setMeal($meal);
            }


            $manager->persist($tag);
            $tag->mergeNewTranslations();
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            MealFixture::class
        );
    }
}