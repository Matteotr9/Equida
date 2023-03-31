<?php

namespace App\Entity;

use App\Repository\ChevalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChevalRepository::class)]
class Cheval
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $sire = null;

    #[ORM\Column(length: 1)]
    private ?string $sexe = null;

   

    #[ORM\ManyToOne(inversedBy: 'chevals')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'chevals')]
    private ?RaceDeCheval $race = null;


    #[ORM\Column]
    private ?float $prixDeDepart = null;

    #[ORM\OneToMany(mappedBy: 'cheval', targetEntity: Lot::class)]
    private Collection $lots;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
  
    private ?string $image = null;

    

   

    public function __construct()
    {
        $this->lots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSire(): ?int
    {
        return $this->sire;
    }

    public function setSire(int $sire): self
    {
        $this->sire = $sire;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getRace(): ?RaceDeCheval
    {
        return $this->race;
    }

    public function setRace(?RaceDeCheval $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection<int, Lot>
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    

    public function getPrixDeDepart(): ?float
    {
        return $this->prixDeDepart;
    }

    public function setPrixDeDepart(float $prixDeDepart): self
    {
        $this->prixDeDepart = $prixDeDepart;

        return $this;
    }

    public function addLot(Lot $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots->add($lot);
            $lot->setCheval($this);
        }

        return $this;
    }

    public function removeLot(Lot $lot): self
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getCheval() === $this) {
                $lot->setCheval(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


  
}
