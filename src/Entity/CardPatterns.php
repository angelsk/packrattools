<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card_patterns",
 *     indexes={
 *         @ORM\Index(name="market", columns={"market"}),
 *         @ORM\Index(name="card_id_2", columns={"card_id", "market", "price", "price_type"})
 *     }
 * )
 * @ORM\Entity
 */
class CardPatterns
{
    use Common\CardTrait;
    use Common\MarketTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
