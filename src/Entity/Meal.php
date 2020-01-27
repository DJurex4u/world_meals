<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="meals")
     */
    private $category;

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

    public function toArray(string $locale){
        return array(
            'id' => $this->id,
            'title' => $this->translate($locale)->getTitle(),
            'description' => $this->translate($locale)->getDescription(),
            'status' => $this->getStatusToString(),
            'category' => $this->getCategory()->toArray($locale),
            'tags' => 'not implemented',
            'ingredients' => ''
        );
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

}
