<?php

namespace App\Entity;

use App\Repository\DressRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DressRepository::class)
 */
class Dress
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
     * @ORM\Column(type="float",nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=DressCategory::class, inversedBy="dresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dressCategory;

    /**
     * @ORM\ManyToMany(targetEntity=Color::class, inversedBy="dresses")
     */
    private $colors;

    /**
     * @ORM\ManyToMany(targetEntity=Detail::class, inversedBy="dresses")
     */
    private $details;

    /**
     * @ORM\OneToMany(targetEntity=DressImage::class, mappedBy="dress")
     */
    private $dressImages;

    /**
     * @ORM\ManyToMany(targetEntity=Size::class, inversedBy="dresses")
     */
    private $sizes;

    /**
     * @ORM\OneToMany(targetEntity=Schedule::class, mappedBy="dress", orphanRemoval=true)
     */
    private $schedules;

    public function __construct()
    {
        $this->colors = new ArrayCollection();
        $this->details = new ArrayCollection();
        $this->dressImages = new ArrayCollection();

        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->sizes = new ArrayCollection();
        $this->schedules = new ArrayCollection();
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

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDressCategory(): ?DressCategory
    {
        return $this->dressCategory;
    }

    public function setDressCategory(?DressCategory $dressCategory): self
    {
        $this->dressCategory = $dressCategory;

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

    public function resetColor()
    {
        $this->colors = new ArrayCollection();
    }

    /**
     * @return Collection|Detail[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
        }

        return $this;
    }

    public function removeDetail(Detail $detail): self
    {
        $this->details->removeElement($detail);

        return $this;
    }

    public function resetDetails()
    {
        $this->details = new ArrayCollection();
    }

    /**
     * @return Collection|DressImage[]
     */
    public function getDressImages(): Collection
    {
        return $this->dressImages;
    }

    public function addDressImage(DressImage $dressImage): self
    {
        if (!$this->dressImages->contains($dressImage)) {
            $this->dressImages[] = $dressImage;
            $dressImage->setDress($this);
        }

        return $this;
    }

    public function removeDressImage(DressImage $dressImage): self
    {
        if ($this->dressImages->removeElement($dressImage)) {
            // set the owning side to null (unless already changed)
            if ($dressImage->getDress() === $this) {
                $dressImage->setDress(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection|Size[]
     */
    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    public function addSize(Size $size): self
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes[] = $size;
        }

        return $this;
    }

    public function removeSize(Size $size): self
    {
        $this->sizes->removeElement($size);

        return $this;
    }

    public function resetSize()
    {
        $this->sizes = new ArrayCollection();
    }

    public function resetImage()
    {
        $this->dressImages = new ArrayCollection();
    }

    /**
     * @return Collection|Schedule[]
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setDress($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getDress() === $this) {
                $schedule->setDress(null);
            }
        }

        return $this;
    }
}
