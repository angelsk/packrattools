<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="family")
 * @ORM\Entity
 */
class Family
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="family_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var DoctrineCollection
     *
     * @ORM\OneToMany(targetEntity="Collection", mappedBy="family")
     */
    private $collections;

    /**
     * @var string
     *
     * @ORM\Column(name="family_name", type="string", length=20, nullable=false)
     */
    public $name;

    /**
     * @var string
     *
     * @ORM\Column(name="family_identifier", type="string", length=25, nullable=false)
     */
    public $identifier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="family_icon", type="string", length=255, nullable=true)
     */
    public $icon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="foil", type="string", length=255, nullable=true)
     */
    public $foil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="family_colour", type="string", length=6, nullable=true)
     */
    public $colour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="family_border", type="string", length=6, nullable=true)
     */
    public $border;

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
     * @param Collection $collection
     */
    public function addCollection(Collection $collection): void
    {
        if (!$this->collections->contains($collection)) {
            $this->collections->add($collection);
        }
    }
}
