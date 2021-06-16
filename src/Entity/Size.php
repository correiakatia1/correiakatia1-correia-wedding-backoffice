<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SizeRepository::class)
 */
class Size
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
     * @ORM\ManyToMany(targetEntity=Dress::class, mappedBy="sizes")
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
            $dress->addSize($this);
        }

        return $this;
    }

    public function removeDress(Dress $dress): self
    {
        if ($this->dresses->removeElement($dress)) {
            $dress->removeSize($this);
        }

        return $this;
    }
}
