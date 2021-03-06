<?php

namespace TK\AbonnementBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator ;

/**
 * AbonnementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AbonnementRepository extends \Doctrine\ORM\EntityRepository
{
    public function getList($page=1, $maxperpage=20)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('abonnement')
            ->from('TKAbonnementBundle:Abonnement','abonnement');

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
}
