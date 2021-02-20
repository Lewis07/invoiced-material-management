<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 * @UniqueEntity(fields={"descrType"},message="Ce type esiste déjà")
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $descrType;

    /**
     * @ORM\OneToMany(targetEntity=SousType::class, mappedBy="type")
     */
    private $sousTypes;

    public function __construct()
    {
        $this->sousTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrType(): ?string
    {
        return $this->descrType;
    }

    public function setDescrType(string $descrType): self
    {
        $this->descrType = $descrType;

        return $this;
    }

    /**
     * @return Collection|SousType[]
     */
    public function getSousTypes(): Collection
    {
        return $this->sousTypes;
    }

    public function addSousType(SousType $sousType): self
    {
        if (!$this->sousTypes->contains($sousType)) {
            $this->sousTypes[] = $sousType;
            $sousType->setType($this);
        }

        return $this;
    }

    public function removeSousType(SousType $sousType): self
    {
        if ($this->sousTypes->removeElement($sousType)) {
            // set the owning side to null (unless already changed)
            if ($sousType->getType() === $this) {
                $sousType->setType(null);
            }
        }

        return $this;
    }
}
