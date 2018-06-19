<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="card",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="card_identifier", columns={"card_identifier", "collection_id"}),
 *          @ORM\UniqueConstraint(name="packrat_api_id", columns={"packrat_id"})
 *      },
 *      indexes={
 *          @ORM\Index(name="collection_id", columns={"collection_id"}), 
 *          @ORM\Index(name="card_type", columns={"card_type"})
 *      }
 * )
 * @ORM\Entity
 */
class Card
{
    /**
     * @var int
     *
     * @ORM\Column(name="card_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="card_identifier", type="string", length=100, nullable=false)
     */
    public $identifier;

    /**
     * @var int|null
     *
     * @ORM\Column(name="packrat_id", type="integer", nullable=false)
     */
    public $apiId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="card_name", type="string", length=100, nullable=true)
     */
    public $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="article", type="string", length=25, nullable=true)
     */
    public $article;

    /**
     * @var int
     *
     * @ORM\Column(name="collection_id", type="integer", nullable=true)
     * @TODO: Link to collection
     */
    public $collectionId;

    /**
     * @var int
     *
     * @ORM\Column(name="point_value", type="smallint", nullable=false)
     */
    public $pointValue = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="ordr", type="boolean", nullable=false)
     */
    public $displayOrder = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="card_type", type="string", length=0, nullable=false)
     * Options: 'normal','draw','rat','recipe'
     */
    public $cardType = 'normal';

    /**
     * @var string|null
     *
     * @ORM\Column(name="medium_image", type="string", length=255, nullable=true)
     */
    public $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="silhouette_image", type="string", length=255, nullable=true)
     */
    public $silhouetteImage;

    /**
     * @var int
     *
     * @ORM\Column(name="num_needed", type="smallint", nullable=false)
     */
    public $quantityNeeded = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="running_total", type="smallint", nullable=false)
     * NOTE: Can't remember what this is used for ATM
     */
    public $runningTotal = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="limited", type="integer", nullable=true)
     */
    public $limited = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="sold_out", type="boolean", nullable=false)
     */
    public $soldOut = false;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false)
     * Options: '','credit','xl','premium'
     */
    public $status = '';

    /**
     * @var int
     *
     * @ORM\Column(name="credit_cost", type="smallint", nullable=false)
     */
    public $creditCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="packrat_credit_cost", type="smallint", nullable=false)
     */
    public $apiCreditCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ticket_cost", type="smallint", nullable=false)
     */
    public $ticketCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="packrat_ticket_cost", type="smallint", nullable=false)
     */
    public $apiTicketCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="draw_cost", type="smallint", nullable=false)
     */
    public $drawCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="rat_cost", type="smallint", nullable=false)
     */
    public $ratCost = 0;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="release_date", type="datetime", nullable=true)
     */
    public $releaseDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="release_datetime", type="datetime", nullable=true)
     */
    public $apiReleaseDate;
}
