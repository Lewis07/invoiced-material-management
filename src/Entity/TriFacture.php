<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class TriFacture
{
    private $dateFacture;

    /**
     * @var ArrayCollection
    */
    private $materiel;

    /**
     * @var ArrayCollection
    */
    private $client;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(?\DateTimeInterface $dateFacture)
    {
        $this->dateFacture = $dateFacture;
    }

    public function getMateriel()
    {
        return $this->materiel;
    }

    public function setMateriel($materiel)
    {
        $this->Materiel = $materiel;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->Materiel = $client;
    }
}
