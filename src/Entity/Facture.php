<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\FactureRepository;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFacture;

    
    /**
     * @ORM\PrePersist
     */
    public function Prepersist()
    {   
        if(empty($this->dateFacture)){
            $this->dateFacture = new \DateTime();
        }
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLengthId()
    {
        return $this->id < 10 ? "FAC0".$this->id :"FAC".$this->id ;
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

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }
}
