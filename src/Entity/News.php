<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card_news",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="news_type", columns={"news_type", "card_id", "collection_id", "market"})
 *     }
 * )
 * @ORM\Entity
 */
class News
{
    use Common\CardAndCollectionTrait;
    use Common\NewsTrait;

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
