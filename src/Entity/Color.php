<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
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
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity=Dress::class, mappedBy="colors")
     * @ORM\JoinTable(name="dress_color")
     */
    private $dresses;

    /**
     * @ORM\ManyToMany(targetEntity=Accessory::class, mappedBy="color")
     * @ORM\JoinTable(name="accessory_color")
     */
    private $accessories;

    public function __construct()
    {
        $this->dresses = new ArrayCollection();
        $this->accessories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Dress[]
     */
    public function getDresses(): Collection
    {
        return $this->dresses;
    }

    public function addDress(Dress $dress): self
    {
        if (!$this->dresses->contains($dress)) {
            $this->dresses[] = $dress;
            $dress->addColor($this);
        }

        return $this;
    }

    public function removeDress(Dress $dress): self
    {
        if ($this->dresses->removeElement($dress)) {
            $dress->removeColor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Accessory[]
     */
    public function getAccessories(): Collection
    {
        return $this->accessories;
    }

    public function addAccessory(Accessory $accessory): self
    {
        if (!$this->accessories->contains($accessory)) {
            $this->accessories[] = $accessory;
            $accessory->addColor($this);
        }

        return $this;
    }

    public function removeAccessory(Accessory $accessory): self
    {
        if ($this->accessories->removeElement($accessory)) {
            $accessory->removeColor($this);
        }

        return $this;
    }
}
