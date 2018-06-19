<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *      name="collection",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="collection_identifier", columns={"collection_identifier"}),
 *          @ORM\UniqueConstraint(name="packrat_idx", columns={"packrat_id"})
 *      },
 *      indexes={@ORM\Index(name="family_id", columns={"family_id"})}
 * )
 * @ORM\Entity
 */
class Collection
{
    /**
     * @var int
     *
     * @ORM\Column(name="collection_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="packrat_id", type="integer", nullable=false)
     */
    public $apiId;

    /**
     * @var string
     *
     * @ORM\Column(name="collection_identifier", type="string", length=100, nullable=false)
     */
    public $identifier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="collection_name", type="string", length=100, nullable=true)
     */
    public $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="family_id", type="integer", nullable=true)
     * @TODO: Link to family
     */
    public $familyId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="collection_icon", type="string", length=255, nullable=true)
     */
    public $icon;

    /**
     * @var bool
     *
     * @ORM\Column(name="num_cards", type="boolean", nullable=false)
     */
    public $numberOfCards = 0;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="release_date", type="date", nullable=true)
     */
    public $releaseDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="release_datetime", type="datetime", nullable=true)
     */
    public $apiReleaseDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expiry_date", type="date", nullable=true)
     */
    public $expiryDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expiry_datetime", type="datetime", nullable=true)
     */
    public $apiExpiryDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feat_card", type="string", length=255, nullable=true)
     * @TODO: Replace with Feat ID
     */
    public $featCard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feat_statement", type="text", nullable=true)
     */
    public $featStatement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="intro_text", type="text", nullable=true)
     */
    public $introText;

    /**
     * @var string|null
     *
     * @ORM\Column(name="artist_id", type="string", length=25, nullable=true)
     * @TODO: Multiple artists - create joining table
     */
    public $artistId;

    /**
     * @var string
     *
     * @ORM\Column(name="related_collection_id", type="string", length=255, nullable=false)
     * @TODO: Multiple related collections - create joining table?
     */
    public $relatedCollectionId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_xl", type="boolean", nullable=false)
     */
    public $isXl = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_premium", type="boolean", nullable=false)
     */
    public $isPremium = false;

    /**
     * @var int
     *
     * @ORM\Column(name="credit_cost", type="smallint", nullable=false)
     */
    public $creditCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ticket_cost", type="smallint", nullable=false)
     */
    public $ticketCost = 0;

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
     * @var bool
     *
     * @ORM\Column(name="special_foils", type="boolean", nullable=false)
     */
    public $specialFoils = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    public $notes;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_changed", type="boolean", nullable=false)
     */
    public $hasChanged = false;
}
