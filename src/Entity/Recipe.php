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
     * @var Card|null
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="ingredient_1", referencedColumnName="card_id", nullable=false)
     */
    private $ingredient1;

    /**
     * @var Card|null
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="ingredient_2", referencedColumnName="card_id", nullable=false)
     */
    private $ingredient2;

    /**
     * @var Card|null
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
     * @param Card $card
     */
    public function setIngredient1(Card $card): void
    {
        $this->ingredient1 = $card;
    }

    /**
     * @param Card $card
     */
    public function setIngredient2(Card $card): void
    {
        $this->ingredient2 = $card;
    }

    /**
     * @param Card $card
     */
    public function setIngredient3(Card $card): void
    {
        $this->ingredient3 = $card;
    }
}
