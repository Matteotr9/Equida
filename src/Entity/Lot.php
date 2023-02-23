<?php

namespace App\Entity;

use App\Repository\LotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Cheval;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LotRepository::class)]
class Lot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   


    #[ORM\ManyToOne(inversedBy: 'lots')]
    private ?Vente $vente = null;

    #[ORM\OneToMany(mappedBy: 'lot', targetEntity: Enchere::class)]
    private Collection $encheres;

  

    #[ORM\ManyToOne(inversedBy: 'lots')]
    private ?Cheval $cheval = null;

    #[ORM\Column]
    private ?float $miseAPrix = null;

    public function __construct()
    {
        $this->encheres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }




    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(?Vente $vente): self
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * @return Collection<int, Enchere>
     */
    public function getEncheres(): Collection
    {
        return $this->encheres;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->encheres->contains($enchere)) {
            $this->encheres->add($enchere);
            $enchere->setLot($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getLot() === $this) {
                $enchere->setLot(null);
            }
        }

        return $this;
    }

 

    public function getCheval(): ?Cheval
    {
        return $this->cheval;
    }

    public function setCheval(?Cheval $cheval): self
    {
        $this->cheval = $cheval;

        return $this;
    }

    public function getMiseAPrix(): ?float
    {
        return $this->miseAPrix;
    }

    public function setMiseAPrix(float $miseAPrix): self
    {
        $this->miseAPrix = $miseAPrix;

        return $this;
    }
}
