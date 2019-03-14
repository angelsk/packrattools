<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="collection",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="collection_identifier", columns={"collection_identifier"}),
 *         @ORM\UniqueConstraint(name="packrat_idx", columns={"packrat_id"})
 *     }
 * )
 * @ORM\Entity
 */
class Collection
{
    use Common\CostTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(name="collection_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Family|null
     *
     * @ORM\ManyToOne(targetEntity="Family", inversedBy="collections")
     * @ORM\JoinColumn(referencedColumnName="family_id")
     */
    private $family;

    /**
     * @var Feat|null
     *
     * @ORM\OneToOne(targetEntity="Feat", mappedBy="collection")
     */
    private $feat;

    /**
     * @var DoctrineCollection
     *
     * @ORM\ManyToMany(targetEntity="Artist", inversedBy="collections")
     * @ORM\JoinTable(
     *     name="collection_artists",
     *     joinColumns={@ORM\JoinColumn(name="collection_id", referencedColumnName="collection_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="artist_id", referencedColumnName="artist_id")}
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $artists;

    /**
     * @var DoctrineCollection
     *
     * @ORM\ManyToMany(targetEntity="Collection")
     * @ORM\JoinTable(
     *     name="related_collections",
     *     joinColumns={@ORM\JoinColumn(name="collection_id", referencedColumnName="collection_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="related_collection_id", referencedColumnName="collection_id")}
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $relatedCollections;

    /**
     * @var DoctrineCollection
     *
     * @ORM\OneToMany(targetEntity="Card", mappedBy="collection")
     * @ORM\OrderBy({"displayOrder" = "ASC", "pointValue" = "DESC"})
     */
    private $cards;

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
     * @var string|null
     *
     * @ORM\Column(name="collection_icon", type="string", length=255, nullable=true)
     */
    public $icon;

    /**
     * @var int
     *
     * @ORM\Column(name="num_cards", type="smallint", nullable=false, options={"default" = 0})
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
     * @ORM\Column(name="intro_text", type="text", nullable=true)
     */
    public $introText;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_xl", type="boolean", nullable=false, options={"default" = false})
     */
    public $isXl = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_premium", type="boolean", nullable=false, options={"default" = false})
     */
    public $isPremium = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="special_foils", type="boolean", nullable=false, options={"default" = false})
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
     * @ORM\Column(name="has_changed", type="boolean", nullable=false, options={"default" = false})
     */
    public $hasChanged = false;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
        $this->artists = new ArrayCollection();
        $this->relatedCollections = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Family|null
     */
    public function getFamily(): ?Family
    {
        return $this->family;
    }

    /**
     * @param Family $family
     */
    public function setFamily(Family $family): void
    {
        $this->family = $family;
    }

    /**
     * @return Feat|null
     */
    public function getFeat(): ?Feat
    {
        return $this->feat;
    }

    /**
     * @param Feat $feat
     */
    public function setFeat(Feat $feat): void
    {
        $this->feat = $feat;
    }

    /**
     * @return DoctrineCollection
     */
    public function getCards(): DoctrineCollection
    {
        return $this->cards;
    }

    /**
     * @return int
     */
    public function getReleasedCards(): int
    {
        return $this->cards->count();
    }

    /**
     * @param Card $card
     */
    public function addCard(Card $card): void
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
        }
    }

    /**
     * @return DoctrineCollection
     */
    public function getArtists(): DoctrineCollection
    {
        return $this->artists;
    }

    /**
     * @return bool
     */
    public function hasArtists(): bool
    {
        return $this->artists->count() > 0;
    }

    /**
     * @param Artist $artist
     */
    public function addArtist(Artist $artist): void
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
        }
    }

    /**
     * @return DoctrineCollection
     */
    public function getRelatedCollections(): DoctrineCollection
    {
        return $this->relatedCollections;
    }

    /**
     * @return bool
     */
    public function hasRelatedCollections(): bool
    {
        return $this->relatedCollections->count() > 0;
    }

    /**
     * @param Collection $collection
     */
    public function addRelatedCollection(Collection $collection)
    {
        if (!$this->relatedCollections->contains($collection)) {
            $this->relatedCollections->add($collection);

            $collection->addRelatedCollection($this); // Reciprocal not not infinite
        }
    }

    /**
     * Retired or retiring in the next two weeka
     *
     * @return bool
     */
    public function isRetireding(): bool
    {
        if (null === $this->expiryDate) {
            return false;
        }

        $twoWeeks = strtotime('+2 week');

        return $twoWeeks >= $this->expiryDate->getTimestamp();
    }

    /**
     * @return bool
     */
    public function isRetired(): bool
    {
        if (null === $this->expiryDate) {
            return false;
        }

        return time() > $this->expiryDate->getTimestamp();
    }
}
