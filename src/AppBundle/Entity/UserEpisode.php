<?php
/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 16/01/17
 * Time: 10:03
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class UserEpisode
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class UserEpisode
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usersEpisodes",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Episode", inversedBy="usersEpisodes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="episodeid", referencedColumnName="id")
     */
    private $episodeId;

    /**
     * @ORM\Column(name="whatchedAt", type="datetime", nullable=false)
     */
    private $watchedAt;

    /**
     * @ORM\Column(name="current",type="boolean", nullable=false)
     */
    private $current;

    /**
     * Set watchedAt
     *
     * @param \DateTime $watchedAt
     *
     * @return UserEpisode
     */
    public function setWatchedAt($watchedAt)
    {
        $this->watchedAt = $watchedAt;

        return $this;
    }

    /**
     * Get watchedAt
     *
     * @return \DateTime
     */
    public function getWatchedAt()
    {
        return $this->watchedAt;
    }

    /**
     * Set current
     *
     * @param boolean $current
     *
     * @return UserEpisode
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return boolean
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     *
     * @return UserEpisode
     */
    public function setUserId(\AppBundle\Entity\User $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set episodeId
     *
     * @param \AppBundle\Entity\Episode $episodeId
     *
     * @return UserEpisode
     */
    public function setEpisodeId(\AppBundle\Entity\Episode $episodeId)
    {
        $this->episodeId = $episodeId;

        return $this;
    }

    /**
     * Get episodeId
     *
     * @return \AppBundle\Entity\Episode
     */
    public function getEpisodeId()
    {
        return $this->episodeId;
    }
}
