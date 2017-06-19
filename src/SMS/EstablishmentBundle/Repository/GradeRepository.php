<?php

namespace SMS\EstablishmentBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GradeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GradeRepository extends EntityRepository
{

  /**
     * Get Grade By Establishment
     *
     * @param Establishment $establishment
     * @return array
     */
	public function findByEstablishment($establishment)
	{
		return $this->createQueryBuilder('grade')
				->join('grade.establishment', 'establishment')
				->andWhere('establishment.id = :establishment')
				->setParameter('establishment', $establishment->getId())
				->getQuery()
				->getResult();
	}
}