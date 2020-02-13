<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $intitule;

    /**
     * @ORM\Column(type="float")
     */
    private $nb_H_CM;

    /**
     * @ORM\Column(type="float")
     */
    private $nb_H_TD;

    /**
     * @ORM\Column(type="float")
     */
    private $nb_H_TP;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cours", mappedBy="module")
     */
    private $cours;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getNbHCM(): ?float
    {
        return $this->nb_H_CM;
    }

    public function setNbHCM(float $nb_H_CM): self
    {
        $this->nb_H_CM = $nb_H_CM;

        return $this;
    }

    public function getNbHTD(): ?float
    {
        return $this->nb_H_TD;
    }

    public function setNbHTD(float $nb_H_TD): self
    {
        $this->nb_H_TD = $nb_H_TD;

        return $this;
    }

    public function getNbHTP(): ?float
    {
        return $this->nb_H_TP;
    }

    public function setNbHTP(float $nb_H_TP): self
    {
        $this->nb_H_TP = $nb_H_TP;

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setModule($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->contains($cour)) {
            $this->cours->removeElement($cour);
            // set the owning side to null (unless already changed)
            if ($cour->getModule() === $this) {
                $cour->setModule(null);
            }
        }

        return $this;
    }
}
