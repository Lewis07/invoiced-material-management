<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomCli;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $prenomCli;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $addresseCli;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="client")
     */
    private $factures;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName()
    {
       return "{$this->getNomCli()} {$this->getPrenomCli()}";
    }

    public function getNomCli(): ?string
    {
        return $this->nomCli;
    }

    public function setNomCli(string $nomCli): self
    {
        $this->nomCli = $nomCli;

        return $this;
    }

    public function getPrenomCli(): ?string
    {
        return $this->prenomCli;
    }

    public function setPrenomCli(string $prenomCli): self
    {
        $this->prenomCli = $prenomCli;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAddresseCli(): ?string
    {
        return $this->addresseCli;
    }

    public function setAddresseCli(string $addresseCli): self
    {
        $this->addresseCli = $addresseCli;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

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
            $facture->setClient($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getClient() === $this) {
                $facture->setClient(null);
            }
        }

        return $this;
    }
}
