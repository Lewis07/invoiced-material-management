<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 * @UniqueEntity(fields={"nomDepartement"},message="Ce département existe déjà")
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nomDepartement;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=14)
     * @Assert\Length(max=13,maxMessage="Le contact est au maximun 10 chiffres")
     */
    private $contactDept;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="departement")
     */
    private $materiels;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDepartement(): ?string
    {
        return $this->nomDepartement;
    }

    public function setNomDepartement(string $nomDepartement): self
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getContactDept(): ?string
    {
        return $this->contactDept;
    }

    public function setContactDept(string $contactDept): self
    {
        $this->contactDept = $contactDept;

        return $this;
    }

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setDepartement($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getDepartement() === $this) {
                $materiel->setDepartement(null);
            }
        }

        return $this;
    }
}
