<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *      name="card_news",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="news_type", columns={"news_type", "identifier", "market"})
 *      }
 * )
 * @ORM\Entity
 */
class News
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
     * @var string
     *
     * @ORM\Column(name="news_type", type="string", length=0, nullable=false, options={"default"="card"})
     * Options: 'card','collection'
     */
    public $type = 'card';

    /**
     * @var string
     *
     * @ORM\Column(name="release_type", type="string", length=0, nullable=false, options={"default"="new"})
     * Options: 'new','existing','draw','rat','recipe','thawed','update_recipe'
     */
    public $releaseType = 'new';

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=100, nullable=false)
     * @TODO: Convert to ID
     */
    public $cardIdentifier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="collection", type="string", length=255, nullable=true)
     * @TODO: Convert to ID
     */
    public $collectionIdentifier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="market", type="string", length=20, nullable=true)
     */
    public $market;

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="string", length=10, nullable=true)
     */
    public $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=false)
     */
    public $timestamp;
}
