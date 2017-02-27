<?php

/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 10/01/17
 * Time: 15:36
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class TvSeries
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class TvSeries
{
    /**
     * @var String
     * @ORM\Column(type="guid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     *
     */
    private $author;
    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $releaseDate;
    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @var string
     */
    private $image;


    /**
     * @ORM\OneToMany(targetEntity="Episode", mappedBy="serie")
     */
    private $episodes;

    /**
     * @return String
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param String $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param String $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTimeInterface $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->episodes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add episode
     *
     * @param \AppBundle\Entity\Episode $episode
     *
     * @return TvSeries
     */
    public function addEpisode(\AppBundle\Entity\Episode $episode)
    {
        $this->episodes[] = $episode;

        return $this;
    }

    /**
     * Remove episode
     *
     * @param \AppBundle\Entity\Episode $episode
     */
    public function removeEpisode(\AppBundle\Entity\Episode $episode)
    {
        $this->episodes->removeElement($episode);
    }

    /**
     * Get episodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }
}
