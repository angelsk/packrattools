<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="feat", indexes={@ORM\Index(name="collection_id", columns={"collection_id"})})
 * @ORM\Entity
 */
class Feat
{
    /**
     * @var int
     *
     * @ORM\Column(name="feat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

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
     * @var int|null
     *
     * @ORM\Column(name="collection_id", type="integer", nullable=true)
     * @TODO: Link to collection
     */
    public $collectionId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feat_card", type="string", length=255, nullable=true)
     * NOTE: I think I'm not using this any more
     */
    public $card;

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
     * @ORM\Column(name="feat_points", type="integer", nullable=false)
     */
    public $points = 1000;

    /**
     * @var int
     *
     * @ORM\Column(name="feat_credits", type="integer", nullable=false)
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
     * @ORM\Column(name="confirmed_num1", type="boolean", nullable=false)
     * NOTE: Do we need this any more now it's in the API?
     */
    public $confirmedNum1 = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="available", type="boolean", nullable=false)
     */
    public $available = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    public $notes;
}
