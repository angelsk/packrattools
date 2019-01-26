<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card_patterns",
 *     indexes={
 *         @ORM\Index(name="card_id", columns={"card_id"}),
 *         @ORM\Index(name="market", columns={"market"}),
 *         @ORM\Index(name="card_id_2", columns={"card_id", "market", "price", "price_type"})
 *     }
 * )
 * @ORM\Entity
 */
class CardPatterns extends CardMarket
{
}
