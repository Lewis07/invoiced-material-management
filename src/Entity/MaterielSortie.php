<?php

namespace App\Entity;

use App\Repository\MaterielSortieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielSortieRepository::class)
 */
class MaterielSortie
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
    private $qteSortie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateSortie;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="materielSorties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteSortie(): ?int
    {
        return $this->qteSortie;
    }

    public function setQteSortie(int $qteSortie): self
    {
        $this->qteSortie = $qteSortie;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

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
}
