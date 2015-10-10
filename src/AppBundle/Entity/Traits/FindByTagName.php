<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Query\Expr;

/**
 * Class FindByTagName
 * @package AppBundle\Entity\Traits
 */
trait FindByTagName
{

    public function findByTagName($name)
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.tags LIKE :name')
            ->setParameter('name','%'.$name.'%');

        return $qb->getQuery()->getResult();
    }
} 