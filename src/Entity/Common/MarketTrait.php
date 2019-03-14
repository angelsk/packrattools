<?php

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

trait MarketTrait
{
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
     * @ORM\Column(name="last_seen", type="datetime", nullable=false)
     */
    public $lastSeen;
}
