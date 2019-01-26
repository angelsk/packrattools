<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card_history",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="card_market_day",
 *             columns={"card_id", "market", "price", "price_type", "price_date"}
 *         )
 *     },
 *     indexes={
 *         @ORM\Index(name="card_id_idx", columns={"card_id"})
 *     }
 * )
 * @ORM\Entity
 */
class CardHistory
{
    use Common\CardTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned" = true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="market", type="string", length=30, nullable=false)
     */
    public $market;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false, options={"default" = 0})
     */
    public $price = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="price_type", type="string", length=0, nullable=false, options={"default" = "Cr"})
     * Options: 'Cr','Tx','Eggs'
     */
    public $type = 'Cr';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="price_date", type="date", nullable=false)
     */
    public $date;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
