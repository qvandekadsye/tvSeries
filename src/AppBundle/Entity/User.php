<?php
/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 16/01/17
 * Time: 09:46
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class User implements UserInterface ,\Serializable
{
    /**
     * @var String
     * @ORM\Column(type="guid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", nullable=false)
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;



    /**
     * @ORM\OneToMany(targetEntity="UserEpisode", mappedBy="id")
     */
    private $userEpisodes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userEpisodes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add userEpisode
     *
     * @param \AppBundle\Entity\UserEpisode $userEpisode
     *
     * @return User
     */
    public function addUserEpisode(\AppBundle\Entity\UserEpisode $userEpisode)
    {
        $this->userEpisodes[] = $userEpisode;

        return $this;
    }

    /**
     * Remove userEpisode
     *
     * @param \AppBundle\Entity\UserEpisode $userEpisode
     */
    public function removeUserEpisode(\AppBundle\Entity\UserEpisode $userEpisode)
    {
        $this->userEpisodes->removeElement($userEpisode);
    }

    /**
     * Get userEpisodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserEpisodes()
    {
        return $this->userEpisodes;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
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
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
       return array('ROLE_USER');
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
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
