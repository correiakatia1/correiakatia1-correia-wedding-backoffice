<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailRepository::class)
 */
class Detail
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
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity=Dress::class, mappedBy="details")
     * @ORM\JoinTable(name="dress_detail")
     */
    private $dresses;

    /**
     * @ORM\ManyToMany(targetEntity=Accessory::class, mappedBy="detail")
      * @ORM\JoinTable(name="accessory_detail")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $dress->addDetail($this);
        }

        return $this;
    }

    public function removeDress(Dress $dress): self
    {
        if ($this->dresses->removeElement($dress)) {
            $dress->removeDetail($this);
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
            $accessory->addDetail($this);
        }

        return $this;
    }

    public function removeAccessory(Accessory $accessory): self
    {
        if ($this->accessories->removeElement($accessory)) {
            $accessory->removeDetail($this);
        }

        return $this;
    }
}
