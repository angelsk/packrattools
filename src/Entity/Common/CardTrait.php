<?php

namespace App\Entity\Common;

use App\Entity\Card;
use Doctrine\ORM\Mapping as ORM;

trait CardTrait
{
    /**
     * @var Card|null
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(referencedColumnName="card_id", nullable=false)
     */
    private $card;

    /**
     * @return Card|null
     */
    public function getCard(): ?Card
    {
        return $this->card;
    }

    /**
     * @param Card $card
     */
    public function setCard(Card $card): void
    {
        $this->card = $card;
    }
}
