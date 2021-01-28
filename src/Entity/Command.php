<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class Command {

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $prenom;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $nom;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[0-9]{10}/"
     * )
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private $address;

    /**
     * @var produit|null
     */
    private $produit;

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     * @return Command
     */
    public function setPrenom(?string $prenom): Command
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return Command
     */
    public function setNom(?string $nom): Command
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Command
     */
    public function setPhone(?string $phone): Command
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Command
     */
    public function setEmail(?string $email): Command
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return Command
     */
    public function setAddress(?string $address): Command
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return produit|null
     */
    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    /**
     * @param produit|null $produit
     * @return Command
     */
    public function setProduit(?produit $produit): Command
    {
        $this->produit = $produit;
        return $this;
    }

}