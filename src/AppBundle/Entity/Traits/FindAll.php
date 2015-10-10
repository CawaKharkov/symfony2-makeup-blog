<?php
/**
 * Created by PhpStorm.
 * User: cawa
 * Date: 18.09.14
 * Time: 23:10
 */

namespace AppBundle\Entity\Traits;


/**
 * Class FindAll
 * @package AppBundle\Entity\Traits
 */
trait FindAll
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p');

        return $qb->getQuery()->getResult();
    }
} 