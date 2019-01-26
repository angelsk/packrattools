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
     * @var int
     *
     * @ORM\Column(name="ingredient_1", type="integer", nullable=false)
     * @TODO: Link to card
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
