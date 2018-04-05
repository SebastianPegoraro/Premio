<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Premio;

/**
 * OrganizacionPrivadaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrganizacionPrivadaRepository extends \Doctrine\ORM\EntityRepository
{
	public function getCant(Premio $premio){

		$qb = $this->createQueryBuilder('op')
			->select('count(op.id)')
			->andWhere('op.premio = :premio')
            ->setParameter('premio', $premio);


		//die(var_dump($qb->getQuery()->getSingleScalarResult())); 
		return  $qb->getQuery()->getSingleScalarResult();
	}

}