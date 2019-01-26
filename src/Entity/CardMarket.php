<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card_market",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="unq_card_market", columns={"card_id", "market"})
 *     },
 *     indexes={
 *         @ORM\Index(name="market", columns={"market"})
 *     }
 * )
 * @ORM\Entity
 */
class CardMarket
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
