<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TextEntityRepository;

/**
 * @ORM\Table(name="text_entity", indexes={
 *  @ORM\Index(name="idx_text_hash", columns={"text_hash"})
 * })
 * @ORM\Entity(repositoryClass=TextEntityRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class TextEntity
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
     * @ORM\Column(name="text_hash", type="string", nullable=true)
     */
    private $textHash;

    /**
     *
     * @ORM\OneToOne(targetEntity="Statistic", mappedBy="textEntity")
     */
    private $statistic;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;


    public function __construct()
    {
        $this->createdDate = new DateTime();
    }


    /**
     * @return TextEntity
     */
    public static function createNewItem(): TextEntity
    {
        return (new TextEntity())
            ->setText('');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->textHash;
    }

    public function setHash(?string $hash): self
    {
        $this->textHash = $hash;
        return $this;
    }
    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedDate(): ?DateTimeInterface
    {
        return $this->createdDate;
    }

    /**
     * @param DateTimeInterface|null $createdDate
     * @return $this
     */
    public function setCreatedDate(?DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return Statistic|null
     */
    public function getStatistic(): ?Statistic
    {
        return $this->statistic;
    }

    /**
     * @return mixed
     */
    public function setStatistic(Statistic $statistic): self
    {
        $this->statistic = $statistic;
        return $this;
    }
}