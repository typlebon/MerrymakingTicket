<?php

namespace App\Entity;

// use App\Entity\Users;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * //permet d'avoir une valeur unique dans la BDD
 * @UniqueEntity("mail")
 */
class Users implements UserInterface,\Serializable
{
    const ROLES = [
        0 => 'ROLE_CUSTOMER',
        1 => 'ROLE_SELLER',
        2 => 'ROLE_MARKETING',
        3 => 'ROLE_MODERATOR',
        4 => 'ROLE_SUPER_ADMIN'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z ÁÀÂÄÃÅÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝÆÇáàâäãåéèêëíìîïñóòôöõúùûüýÿæç\'0-9,\.\-\_]{1,10}+$/",
     *     message="Veuillez saisir un nom valide"
     * )
     */
    private $name_users;

    /**
     * @ORM\Column(type="string", length=50)
     *  @Assert\Regex(
     *      pattern= "/^[A-Za-z ÁÀÂÄÃÅÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝÆÇáàâäãåéèêëíìîïñóòôöõúùûüýÿæç\'0-9,\.\-\_]{1,10}+$/",
     *      message="Veuillez saisir un prénom valide"
     * )
     */
    private $firstname_users;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Regex(
     *     pattern= "/([0-9]{2}){4}[0-9]{2}/",
     *     message="Veuillez saisir un numéro de téléphone valide"
     * )
     */
    private $phone_number_users;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Regex(
     *      pattern= "/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/",
     *      message="Veuillez saisir un mail valide"
     * )
     */
    private $mail;

    /**
      * @ORM\Column(type="string", length=60)
      * @Assert\Regex(
      *      pattern= "/^[A-Za-z ÁÀÂÄÃÅÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝÆÇáàâäãåéèêëíìîïñóòôöõúùûüýÿæç\'0-9,\.\-\_]{1,10}+$/",
      *      message="Veuillez saisir un mot de passe valide"
      * )
     */
    private $password_users;

    /**
     * @ORM\Column(type="integer")
     */
    private $role;

    
    private $retype_password_users;

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

    public function getPasswordUsers(): ?string
    {
        return $this->password_users;
    }

    public function setPasswordUsers(string $password_users): self
    {
        $this->password_users = $password_users;

        return $this;
    }

    public function getRetypePasswordUsers(): ?string
    {
        return $this->retype_password_users;
    }

    public function setRetypePasswordUsers(string $retype_password_users): self
    {
        $this->retype_password_users = $retype_password_users;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles() : array
    {
        $numero = $this->getRole();
        
        // 4
        if ($numero == array_search('ROLE_SUPER_ADMIN', self::ROLES))
        {
            $tableau = array(
                self::ROLES[0],
                self::ROLES[1],
                self::ROLES[2],
                self::ROLES[3],
                self::ROLES[4],
            );
            return $tableau;
        }

        // 0-3
        else {
            $mot = self::ROLES[$numero];            
            return array($mot);   
        }

    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * String representation of object
     * @link https://php.net/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */

     public function serialize()
     {
         return serialize([
             $this->id,
             $this->mail,
             $this->password_users
         ]);
     }

     /**
      * Constructs the object
      * @link https://php.net/manual/en/serializable.unserialize.php
      * @param string $serialized <p>
      * The string representation of the object.
      * </p>
      * @return void
      * @since 5.1.0
      */
     public function unserialize($serialized)
     {
        list (
            $this->id,
            $this->mail,
            $this->password_users
        ) = unserialize ($serialized, ['allowed_classes' => false]);
     }

     public function getUsername(): ?string
     {
         return $this->mail;
     }

     public function getPassword(): ?string
     {
         return $this->password_users;
     }

     public function getRole(): ?int
     {
         return $this->role;
     }

     public function setRole(int $role): self
     {
         $this->role = $role;

         return $this;
     }

}

