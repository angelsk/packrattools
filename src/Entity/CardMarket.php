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
 *         @ORM\Index(name="card_id", columns={"card_id"}),
 *         @ORM\Index(name="market", columns={"market"})
 *     }
 * )
 * @ORM\Entity
 */
class CardMarket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var int
     *
     * @ORM\Column(name="card_id", type="integer", nullable=false)
     * @TODO: Link to card
     */
    public $cardId;

    /**
     * @var string
     *
     * @ORM\Column(name="market", type="string", length=30, nullable=false)
     */
    public $market;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
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
     * @ORM\Column(name="last_seen", type="datetime", nullable=false)
     */
    public $lastSeen;
}
