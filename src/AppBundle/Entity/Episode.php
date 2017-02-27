<?php
/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 16/01/17
 * Time: 08:52
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Episode
 * @package AppBundle\Entity
 * @ORM\Entity
 *
 */
class Episode
{
    /**
     * @var String
     * @ORM\Column(type="guid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var String
     * @ORM\Column(type="string", nullable=true, length=50)
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $episodeNumber;

    /**
     * @var
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datePublished;

    /**
     * @var String
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @var String
     * @ORM\Column(type="string", nullable=true)
     */
    private $imageURL;

    /**
     * @ORM\ManyToOne(targetEntity="TvSeries", inversedBy="episodes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="tvSeries_id", referencedColumnName="id")
     */
    private $serie;

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
     * Set name
     *
     * @param string $name
     *
     * @return Episode
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set episodeNumber
     *
     * @param integer $episodeNumber
     *
     * @return Episode
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = $episodeNumber;

        return $this;
    }

    /**
     * Get episodeNumber
     *
     * @return integer
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * Set datePublished
     *
     * @param \DateTime $datePublished
     *
     * @return Episode
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Episode
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageURL
     *
     * @param string $imageURL
     *
     * @return Episode
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;

        return $this;
    }

    /**
     * Get imageURL
     *
     * @return string
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * Set serie
     *
     * @param \AppBundle\Entity\TvSeries $serie
     *
     * @return Episode
     */
    public function setSerie(\AppBundle\Entity\TvSeries $serie = null)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return \AppBundle\Entity\TvSeries
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Add userEpisode
     *
     * @param \AppBundle\Entity\UserEpisode $userEpisode
     *
     * @return Episode
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
}
