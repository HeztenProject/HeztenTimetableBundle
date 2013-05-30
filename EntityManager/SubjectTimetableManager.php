<?php

namespace Hezten\TimetableBundle\EntityManager;

use Hezten\TimetableBundle\ModelManager\SubjectTimetableManager as BaseSubjectTimetableManager;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Types\Type;

use SanFidel\AdminBundle\Entity\Teacher;
use SanFidel\AdminBundle\Entity\Tutor;

/**
 * Default ORM SubjectTimetableManager.
 *
 * @author Gorka Lauzirika <gorka.lauzirika@gmail.com>
 */
class SubjectTimetableManager extends BaseSubjectTimetableManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;


    /**
     * Constructor.
     *
     * @param EntityManager     $em
     * @param string            $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->name;
    }

    /**
     * Returns a SubjectTimetable item list for the given teacher and dates
     * 
     * @param Teacher $teacher The teacher asking for the timetable
     * @param \DateTime $beginDate The beginDate of the timetable
     * @param \DateTime $finishDate The finishDate of the timetable
     */
    public function findTimetableByTeacher(Teacher $teacher, \DateTime $beginDate, \DateTime $finishDate)
    {        
        $query = $this->em->createQuery(
                "SELECT s,t,st,c,cat
                FROM ". $this->class ." st JOIN st.subject s JOIN s.course c JOIN c.category cat JOIN s.teacher t 
                WHERE t.id = :teacherId AND st.beginDate <= :beginDate AND st.finishDate >= :finishDate
                ORDER BY st.weekday ASC, st.beginTime ASC, st.finishTime ASC"
                );
        
        $query->setParameter('teacherId',$teacher->getId());
        $query->setParameter('beginDate', $beginDate,Type::DATE);
        $query->setParameter('finishDate', $finishDate,Type::DATE);

        return $query->execute();
        
    }

    /**
     * Returns many arrays (one per each student) filled of SubjectTimetable items for the given tutor and dates.
     *  $timetable[$studentId] will be all the scheduled lessons for that student
     *
     * @param Tutor $tutor The tutor asking for the timetable
     * @param \DateTime $beginDate The beginDate of the timetable
     * @param \DateTime $finishDate The finishDate of the timetable
     */

    public function findTimetableByTutor(Tutor $tutor, \DateTime $beginDate, \DateTime $finishDate)
    {
        $query = $this->em->createQuery(
                "SELECT s,e,st,sp,t,stu,c, cc
                FROM ". $this->class ." st JOIN st.subject s JOIN s.enroled e JOIN e.student stu JOIN stu.studentParents sp JOIN sp.tutor t JOIN s.course c JOIN c.category cc
                WHERE t.id = :tutorId AND st.beginDate <= :beginDate AND st.finishDate >= :finishDate
                ORDER BY stu.id ASC, st.weekday ASC, st.beginTime ASC, st.finishTime ASC"
                );
        
        $query->setParameter('tutorId',$tutor->getId());
        $query->setParameter('beginDate', $beginDate,Type::DATE);
        $query->setParameter('finishDate', $finishDate,Type::DATE);

        $timetable = $query->execute();

        $childrenTimetable = array();
        
        foreach ($timetable as $tim)
        {
            /* Get the enroled students */
            $en = $tim->getSubject()->getEnroled();
            /* Our student will be the 0 as we wont have any more than that one */
            /* Append the timetable item to the array of the student */
            $childrenTimetable[$en[0]->getStudent()->getId()][] = $tim; 
        }

        return $childrenTimetable;
    }
}