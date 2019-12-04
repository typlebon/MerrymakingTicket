<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
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
    private $name_users;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname_users;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone_number_users;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameUsers(): ?string
    {
        return $this->name_users;
    }


    public function setNameUsers(string $name_users): self
    {
        $this->name_users = $name_users;

        return $this;
    }

    public function getSlug()
    {
        return (new Slugify())->slugify($this->name_users);
    }

    public function getFirstnameUsers(): ?string
    {
        return $this->firstname_users;
    }

    public function setFirstnameUsers(string $firstname_users): self
    {
        $this->firstname_users = $firstname_users;

        return $this;
    }

    public function getphoneNumberUsers(): ?string
    {
        return $this->phone_number_users;
    }

    public function setPhoneNumberUsers(string $phone_number_users): self
    {
        $this->phone_number_users = $phone_number_users;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
}
