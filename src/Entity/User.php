<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $PassWord;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $EmailAdresse;

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

    public function getPassWord(): ?string
    {
        return $this->PassWord;
    }

    public function setPassWord(string $PassWord): self
    {
        $this->PassWord = $PassWord;

        return $this;
    }

    public function getEmailAdresse(): ?string
    {
        return $this->EmailAdresse;
    }

    public function setEmailAdresse(string $EmailAdresse): self
    {
        $this->EmailAdresse = $EmailAdresse;

        return $this;
    }
}
