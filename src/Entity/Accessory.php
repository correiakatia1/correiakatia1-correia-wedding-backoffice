<?php

namespace App\Entity;

use App\Repository\AccessoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccessoryRepository::class)
 */
class Accessory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=AccessoryCategory::class, inversedBy="accessories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accessoryCategory;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\ManyToMany(targetEntity=Color::class, inversedBy="accessories")
     */
    private $colors;

    /**
     * @ORM\ManyToMany(targetEntity=detail::class, inversedBy="accessories")
     */
    private $details;

    public function __construct()
    {
        $this->colors = new ArrayCollection();
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getAccessoryCategory(): ?AccessoryCategory
    {
        return $this->accessoryCategory;
    }

    public function setAccessoryCategory(?AccessoryCategory $accessoryCategory): self
    {
        $this->accessoryCategory = $accessoryCategory;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection|Color[]
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        $this->colors->removeElement($color);

        return $this;
    }

    /**
     * @return Collection|detail[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(detail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
        }

        return $this;
    }

    public function removeDetail(detail $detail): self
    {
        $this->details->removeElement($detail);

        return $this;
    }
}
