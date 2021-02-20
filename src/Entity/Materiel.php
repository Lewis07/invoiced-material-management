<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateApprovisionnement;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $designation;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitaire;

    /**
     * @ORM\OneToMany(targetEntity=MaterielEntree::class, mappedBy="materiel")
     */
    private $materielEntrees;

    /**
     * @ORM\OneToMany(targetEntity=MaterielSortie::class, mappedBy="materiel")
     */
    private $materielSorties;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="materiel")
     */
    private $clients;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="materiels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="materiel")
     */
    private $factures;

    /**
     * @ORM\ManyToOne(targetEntity=SousType::class, inversedBy="materiels")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $sousType;

    public function __construct()
    {
        $this->materielEntrees = new ArrayCollection();
        $this->materielSorties = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalMateriel()
    {
        $qte = ($this->qte) != 0 ? $this->qte : 0;
        $qteEntree = array_reduce($this->materielEntrees->toArray(),function($total,$me)
        {
            return $total + ($me->getQteEntree() != "0" ? $me->getQteEntree() : 0);
        },0);
        $qteSortie = array_reduce($this->materielSorties->toArray(),function($total,$ms)
        {
            return $total + ($ms->getQteSortie() != "0" ? $ms->getQteSortie() : 0);
        },0);
        return $qte + $qteEntree - $qteSortie;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getDateApprovisionnement(): ?\DateTimeInterface
    {
        return $this->dateApprovisionnement;
    }

    public function setDateApprovisionnement(\DateTimeInterface $dateApprovisionnement): self
    {
        $this->dateApprovisionnement = $dateApprovisionnement;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    /**
     * @return Collection|MaterielEntree[]
     */
    public function getMaterielEntrees(): Collection
    {
        return $this->materielEntrees;
    }

    public function addMaterielEntree(MaterielEntree $materielEntree): self
    {
        if (!$this->materielEntrees->contains($materielEntree)) {
            $this->materielEntrees[] = $materielEntree;
            $materielEntree->setMateriel($this);
        }

        return $this;
    }

    public function removeMaterielEntree(MaterielEntree $materielEntree): self
    {
        if ($this->materielEntrees->removeElement($materielEntree)) {
            // set the owning side to null (unless already changed)
            if ($materielEntree->getMateriel() === $this) {
                $materielEntree->setMateriel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MaterielSortie[]
     */
    public function getMaterielSorties(): Collection
    {
        return $this->materielSorties;
    }

    public function addMaterielSorty(MaterielSortie $materielSorty): self
    {
        if (!$this->materielSorties->contains($materielSorty)) {
            $this->materielSorties[] = $materielSorty;
            $materielSorty->setMateriel($this);
        }

        return $this;
    }

    public function removeMaterielSorty(MaterielSortie $materielSorty): self
    {
        if ($this->materielSorties->removeElement($materielSorty)) {
            // set the owning side to null (unless already changed)
            if ($materielSorty->getMateriel() === $this) {
                $materielSorty->setMateriel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setMateriel($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getMateriel() === $this) {
                $client->setMateriel(null);
            }
        }

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setMateriel($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getMateriel() === $this) {
                $facture->setMateriel(null);
            }
        }

        return $this;
    }

    public function getSousType(): ?SousType
    {
        return $this->sousType;
    }

    public function setSousType(?SousType $sousType): self
    {
        $this->sousType = $sousType;

        return $this;
    }
}
