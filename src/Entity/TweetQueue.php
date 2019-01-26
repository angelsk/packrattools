<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="queue", indexes={@ORM\Index(name="published", columns={"published"})})
 * @ORM\Entity
 */
class TweetQueue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    public $type;

    /**
     * @var string
     *
     * @ORM\Column(name="tweet", type="string", length=255, nullable=false)
     */
    public $tweet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    public $createdAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean", nullable=false, options={"default" = false})
     */
    public $published = false;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    public $publishedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="pause", type="boolean", nullable=false, options={"default" = false})
     */
    public $pause = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="push", type="boolean", nullable=false, options={"default" = false})
     */
    public $push = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error", type="string", length=255, nullable=true)
     */
    public $error;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
