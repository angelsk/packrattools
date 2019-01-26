<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card_recipe",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="card_id", columns={"card_id"})}
 * )
 * @ORM\Entity
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="recipe_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var int
     *
     * @ORM\Column(name="card_id", type="integer", nullable=false)
     * @TODO: Link to cards
     */
    public $cardId;

    /**
     * @var int
     *
     * @ORM\Column(name="ingredient_1", type="integer", nullable=false)
     */
    public $ingredient1;

    /**
     * @var int
     *
     * @ORM\Column(name="ingredient_2", type="integer", nullable=false)
     */
    public $ingredient2;

    /**
     * @var int
     *
     * @ORM\Column(name="ingredient_3", type="integer", nullable=false)
     */
    public $ingredient3;
}
