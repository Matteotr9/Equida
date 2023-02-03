<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nom = null;

    #[ORM\Column(length: 40)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_de_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Cheval::class, orphanRemoval: true)]
    private Collection $chevals;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Enchere::class)]
    private Collection $encheres;

   

    #[ORM\ManyToOne(inversedBy: 'clients')]
    private ?Pays $pays = null;

    #[ORM\ManyToMany(targetEntity: CategorieDeVente::class, inversedBy: 'clients')]
    private Collection $categorieDeVente;

    public function __construct()
    {
        $this->chevals = new ArrayCollection();
        $this->encheres = new ArrayCollection();
        $this->categorieDeVente = new ArrayCollection();
      
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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
            $cheval->setClient($this);
        }

        return $this;
    }

    public function removeCheval(Cheval $cheval): self
    {
        if ($this->chevals->removeElement($cheval)) {
            // set the owning side to null (unless already changed)
            if ($cheval->getClient() === $this) {
                $cheval->setClient(null);
            }
        }

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
            $enchere->setClient($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getClient() === $this) {
                $enchere->setClient(null);
            }
        }

        return $this;
    }

    

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, CategorieDeVente>
     */
    public function getCategorieDeVente(): Collection
    {
        return $this->categorieDeVente;
    }

    public function addCategorieDeVente(CategorieDeVente $categorieDeVente): self
    {
        if (!$this->categorieDeVente->contains($categorieDeVente)) {
            $this->categorieDeVente->add($categorieDeVente);
        }

        return $this;
    }

    public function removeCategorieDeVente(CategorieDeVente $categorieDeVente): self
    {
        $this->categorieDeVente->removeElement($categorieDeVente);

        return $this;
    }
}
