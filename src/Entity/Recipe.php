<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="card_recipe")
 * @ORM\Entity
 */
class Recipe
{
    use Common\CardTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="recipe_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Card
     *
     * @ORM\OneToOne(targetEntity="Card", inversedBy="recipe")
     * @ORM\JoinColumn(referencedColumnName="card_id", nullable=false)
     */
    private $card;

    /**
     * @var Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="ingredient_1", referencedColumnName="card_id", nullable=false)
     */
    private $ingredient1;

    /**
     * @var Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="ingredient_2", referencedColumnName="card_id", nullable=false)
     */
    private $ingredient2;

    /**
     * @var Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="ingredient_3", referencedColumnName="card_id", nullable=false)
     */
    private $ingredient3;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Card[]
     */
    public function getIngredients(): array
    {
        return [
            $this->ingredient1,
            $this->ingredient2,
            $this->ingredient3
        ];
    }

    /**
     * @return Card
     */
    public function getIngredient1(): Card
    {
        return $this->ingredient1;
    }

    /**
     * @param Card $card
     */
    public function setIngredient1(Card $card): void
    {
        $this->ingredient1 = $card;

        if ($this->card->getCollection() !== $card->getCollection()) {
            $this->card->getCollection()->addRelatedCollection($card->getCollection());
        }
    }

    /**
     * @return Card
     */
    public function getIngredient2(): Card
    {
        return $this->ingredient2;
    }

    /**
     * @param Card $card
     */
    public function setIngredient2(Card $card): void
    {
        $this->ingredient2 = $card;

        if ($this->card->getCollection() !== $card->getCollection()) {
            $this->card->getCollection()->addRelatedCollection($card->getCollection());
        }
    }

    /**
     * @return Card
     */
    public function getIngredient3(): Card
    {
        return $this->ingredient3;
    }

    /**
     * @param Card $card
     */
    public function setIngredient3(Card $card): void
    {
        $this->ingredient3 = $card;

        if ($this->card->getCollection() !== $card->getCollection()) {
            $this->card->getCollection()->addRelatedCollection($card->getCollection());
        }
    }
}
