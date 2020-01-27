<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meal", inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMeals(): ?Meal
    {
        return $this->meal;
    }

    public function setMeals(?Meal $meal): self
    {
        $this->meals = $meal;

        return $this;
    }

    public function toArray(string $locale)
    {
        return array(
            'id' => $this->id,
            'title' => $this->translate($locale)->getTitle(),
            'slug' => $this->slug
        );
    }
}
