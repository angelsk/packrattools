<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="artist")
 * @ORM\Entity
 */
class Artist
{
    /**
     * @var int
     *
     * @ORM\Column(name="artist_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var DoctrineCollection
     *
     * @ORM\ManyToMany(targetEntity="Collection", mappedBy="artists")
     */
    private $collections;

    /**
     * @var string
     *
     * @ORM\Column(name="artist_identifier", type="string", length=100, nullable=false)
     */
    public $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="artist_name", type="string", length=100, nullable=false)
     */
    public $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    public $image;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255, nullable=false)
     */
    public $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=6, nullable=false)
     */
    public $colour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="string", length=100, nullable=true)
     */
    public $website;

    /**
     * @var string|null
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    public $information;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DoctrineCollection
     */
    public function getCollections(): DoctrineCollection
    {
        return $this->collections;
    }

    /**
     * @return int
     */
    public function getCollectionCount(): int
    {
        return $this->collections->count();
    }

    /**
     * @return int
     */
    public function getCurrentCollectionCount(): int
    {
        $currentCollections = $this->collections->filter(function (Collection $collection) {
            return !$collection->isRetired();
        });

        return $currentCollections->count();
    }
}
