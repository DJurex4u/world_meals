<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MealRepository")
 */
class Meal implements TranslatableInterface
{
    use TranslatableTrait;

    public function __construct()
    {
        $this->status = true;
        $this->ingredients = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category", mappedBy="meal")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ingredient", mappedBy="meal")
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tag", mappedBy="meal")
     */
    private $tags;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function getStatusToString(): string
    {
        if($this->getStatus())
        {
            return 'Created';
        }else
        {
            return 'Deleted';
        }

    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function changeStatus(): self
    {
        $this->status = !$this->status;

        return $this;
    }

    public function toArray(string $locale)
    {
        $category = $this->getCategory();
        if(!$category){
            $categoryArr = null;
        }else{
            $categoryArr = $category->toArray($locale);
        }

        return array(
            'id' => $this->id,
            'title' => $this->translate($locale)->getTitle(),
            'description' => $this->translate($locale)->getDescription(),
            'status' => $this->getStatusToString(),
            'category' => $categoryArr,
            'tags' => $this->tagsToArray($locale),
            'ingredients' => $this->ingredientsToArray($locale)
        );
    }
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setMeal($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            // set the owning side to null (unless already changed)
            if ($ingredient->getMeal() === $this) {
                $ingredient->setMeal(null);
            }
        }

        return $this;
    }

    public function ingredientsToArray(string $locale)
    {
        $ingredients = $this->getIngredients();
        $ingredientsReadable = new ArrayCollection();
        foreach ($ingredients as $ingredient)
        {
            $ingredientsReadable->add($ingredient->toArray($locale));
        }
        return $ingredientsReadable->toArray();

    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->setMeal($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            // set the owning side to null (unless already changed)
            if ($tag->getMeal() === $this) {
                $tag->setMeal(null);
            }
        }

        return $this;
    }

    public function tagsToArray(string $locale)
    {
        $tags = $this->getTags();
        $tagsReadable = new ArrayCollection();
        foreach ($tags as $tag)
        {
            $tagsReadable->add($tag->toArray($locale));
        }
        return $tagsReadable->toArray();
    }

}
