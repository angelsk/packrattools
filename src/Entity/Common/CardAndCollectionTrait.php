<?php

namespace App\Entity\Common;

use App\Entity\Card;
use App\Entity\Collection;
use Doctrine\ORM\Mapping as ORM;

trait CardAndCollectionTrait
{
    /**
     * @var Card|null
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(referencedColumnName="card_id")
     */
    private $card;

    /**
     * @var Collection|null
     *
     * @ORM\ManyToOne(targetEntity="Collection")
     * @ORM\JoinColumn(referencedColumnName="collection_id")
     */
    private $collection;

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

    /**
     * @return Collection|null
     */
    public function getCollection(): ?Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }
}
