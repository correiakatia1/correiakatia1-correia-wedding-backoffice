<?php

namespace App\Entity;

use App\Repository\DressCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DressCategoryRepository::class)
 */
class DressCategory
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
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity=Dress::class, mappedBy="dressCategory")
     */
    private $dresses;

    public function __construct()
    {
        $this->dresses = new ArrayCollection();
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
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $dress->setDressCategory($this);
        }

        return $this;
    }

    public function removeDress(Dress $dress): self
    {
        if ($this->dresses->removeElement($dress)) {
            // set the owning side to null (unless already changed)
            if ($dress->getDressCategory() === $this) {
                $dress->setDressCategory(null);
            }
        }

        return $this;
    }
}
