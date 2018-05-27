<?php

namespace TK\CoursBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator ;

class ThemeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getList($page=1, $maxperpage=20)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('theme')
            ->from('TKCoursBundle:Theme','theme');

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
}
