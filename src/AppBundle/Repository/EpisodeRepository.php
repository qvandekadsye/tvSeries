<?php

/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 17/02/17
 * Time: 11:11
 */
class EpisodeRepository extends \Doctrine\ORM\EntityRepository
{
    public function EpisodeUser($userId, $episodeId)
    {
        $query = $this->createQueryBuilder('e')
            ->join('e.userEpisodes','ue')
            ->where("ue.userId = :u")
            ->andWhere("ue.episodeId = :e")
            ->setParameters(array('u'=>$userId, 'e' =>$episodeId))
            ->getQuery();
        return $query->getResult();
    }
}