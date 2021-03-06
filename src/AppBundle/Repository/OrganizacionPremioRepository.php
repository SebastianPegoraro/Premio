<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Premio;

/**
 * OrganizacionPremioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrganizacionPremioRepository extends \Doctrine\ORM\EntityRepository
{
  public function getCantOrgPrivadas(Premio $premio){

		$qb = $this->createQueryBuilder('op')
			->select('count(op.id)')
      ->innerJoin('op.organizacion', 'o')
			->andWhere('op.premio = :premio')
      ->andWhere('o INSTANCE OF AppBundle:OrganizacionPrivada')
            ->setParameter('premio', $premio);


		//die(var_dump($qb->getQuery()->getSingleScalarResult()));
		return  $qb->getQuery()->getSingleScalarResult();
	}

  public function getCantOrgPublicas(Premio $premio){

		$qb = $this->createQueryBuilder('op')
			->select('count(op.id)')
      ->innerJoin('op.organizacion', 'o')
			->andWhere('op.premio = :premio')
      ->andWhere('o INSTANCE OF AppBundle:OrganizacionPublica')
      ->setParameter('premio', $premio);


		//die(var_dump($qb->getQuery()->getSingleScalarResult()));
		return  $qb->getQuery()->getSingleScalarResult();
	}
}
