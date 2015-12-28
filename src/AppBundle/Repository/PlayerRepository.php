<?php

namespace AppBundle\Repository;

/**
 * PlayerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerRepository extends \Doctrine\ORM\EntityRepository
{
    public function findPlayerByTeam($team, $player)
    {
        $dql = "SELECT p, t FROM AppBundle:Player p JOIN p.team t WHERE p.name = :player AND t.name = :team";
        return $this->getEntityManager()->createQuery($dql)->setParameter('player', $player)->setParameter('team', $team)->getOneOrNullResult();
    }

    public function findAllPlayersByTeam($team)
    {
        $dql = "SELECT p, t FROM AppBundle:Player p JOIN p.team t WHERE t.name = :team ORDER BY p.name ASC";
        return $this->getEntityManager()->createQuery($dql)->setParameter('team', $team)->getResult();
    }
}
