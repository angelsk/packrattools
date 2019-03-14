<?php

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

trait NewsTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="news_type", type="string", length=0, nullable=false, options={"default" = "card"})
     * Options: 'card','collection'
     */
    public $type = 'card';

    /**
     * @var string
     *
     * @ORM\Column(name="release_type", type="string", length=0, nullable=false, options={"default" = "new"})
     * Options: 'new','existing','draw','rat','recipe','thawed','update_recipe'
     */
    public $releaseType = 'new';

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
