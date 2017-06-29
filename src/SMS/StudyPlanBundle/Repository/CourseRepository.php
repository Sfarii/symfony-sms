<?php

namespace SMS\StudyPlanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SMS\StudyPlanBundle\Entity\Note;

/**
 * CourseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CourseRepository extends EntityRepository
{

	/**
     * Get Course By Grade
     *
     * @param integer $grade
     * @return array
     */
	public function findByGradeAndDivision($grade , $division)
	{
		return $this->createQueryBuilder('course')
				->select('partial course.{id,courseName,coefficient}')
				->join('course.grade', 'grade')
				->join('course.division', 'division')
				->andWhere('division.id = :division')
				->andWhere('grade.id = :grade')
				->setParameter('grade', $grade)
				->setParameter('division', $division)
				->getQuery()
				->getResult();
	}


	/**
     * Get Note By ids
     *
     * @param SMS\EstablishmentBundle\Entity\Division $division
     * @param SMS\UserBundle\Entity\Student $student
     * @return array
     */
	public function findByStudent($student, $division)
	{
			$markQuery = $this->_em->createQueryBuilder()
												->select("GROUP_CONCAT(note.mark SEPARATOR ', ' )")
												->from(Note::class, 'note')
						            ->join('note.student', 'student')
						            ->Where('note.exam MEMBER OF course.exams')
						            ->andWhere('student.id = :student')
						            ->getDQL();
		return $this->createQueryBuilder('course')
				->select('division.id,typeExam.id , typeExam.typeExamName , course.courseName , course.id , exams.id')
				->addSelect(sprintf("( %s ) as mark",$markQuery))
				->join('course.exams', 'exams')
				->join('exams.typeExam', 'typeExam')
				->join('course.division', 'division')
				->having(':section MEMBER OF exams.section')
				->andHaving('division.id = :division')
				->groupBy('typeExam.id ,course.id')
				->setParameter('division', $division->getId())
				->setParameter('student', $student->getId())
				->setParameter('section',  $student->getSection())
				->getQuery()
        ->getResult();
	}

}
