<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

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
            'id' => $this->getId(),
            'title' => $this->translate($locale)->getTitle(),
            'description' => $this->translate($locale)->getDescription(),
            'status' => $this->getStatusToString(),
            'category' => 'not implemented',
            'tags' => 'not implemented',
            'ingredients' => ''
        );
    }

}
