<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="feat")
 * @ORM\Entity
 */
class Feat
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="feat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Collection|null
     *
     * @ORM\OneToOne(targetEntity="Collection", inversedBy="feat")
     * @ORM\JoinColumn(referencedColumnName="collection_id")
     */
    private $collection;

    /**
     * @var string
     *
     * @ORM\Column(name="feat_identifier", type="string", length=100, nullable=false)
     */
    public $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="feat_name", type="string", length=255, nullable=false)
     */
    public $name;

    /**
     * @var string
     *
     * @ORM\Column(name="feat_title", type="string", length=255, nullable=false)
     */
    public $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feat_image", type="string", length=255, nullable=true)
     */
    public $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feat_statement", type="text", nullable=true)
     */
    public $statement;

    /**
     * @var int
     *
     * @ORM\Column(name="feat_points", type="integer", nullable=false, options={"default" = 1000})
     */
    public $points = 1000;

    /**
     * @var int
     *
     * @ORM\Column(name="feat_credits", type="integer", nullable=false, options={"default" = 1000})
     */
    public $credits = 1000;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_achieved", type="date", nullable=true)
     */
    public $dateAchieved;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datetime_achieved", type="datetime", nullable=true)
     */
    public $apiDateAchieved;

    /**
     * @var bool
     *
     * @ORM\Column(name="available", type="boolean", nullable=false, options={"default" = true})
     */
    public $available = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    public $notes;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
