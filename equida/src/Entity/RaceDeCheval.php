<?php

namespace App\Entity;

use App\Repository\RaceDeChevalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceDeChevalRepository::class)]
class RaceDeCheval
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libellle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'race', targetEntity: Cheval::class)]
    private Collection $chevals;

    public function __construct()
    {
        $this->chevals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellle(): ?string
    {
        return $this->libellle;
    }

    public function setLibellle(string $libellle): self
    {
        $this->libellle = $libellle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Cheval>
     */
    public function getChevals(): Collection
    {
        return $this->chevals;
    }

    public function addCheval(Cheval $cheval): self
    {
        if (!$this->chevals->contains($cheval)) {
            $this->chevals->add($cheval);
            $cheval->setRace($this);
        }

        return $this;
    }

    public function removeCheval(Cheval $cheval): self
    {
        if ($this->chevals->removeElement($cheval)) {
            // set the owning side to null (unless already changed)
            if ($cheval->getRace() === $this) {
                $cheval->setRace(null);
            }
        }

        return $this;
    }
}
