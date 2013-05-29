<?php

namespace Hezten\HeztenTimetableBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

use Hezten\CoreBundle\Entity\Subject;

abstract class SubjectTimetable
{

	private $id;
	
	/** 
	 *	@Assert\Max(limit = 7)
	 *	@Assert\Min(limit = 1) 
	 */
	private $weekday;
	
	/** 
	 *  @Assert\Time
	 */
	private $beginTime;
	
	/** 
	 *  @Assert\Time  
	 */
	private $finishTime;
	
	/**  
	 *	@Assert\Date 
	 */
	private $beginDate;
	
	/** 
	 *  @Assert\Date 
	 */
	private $finishDate;
	
	private $subject;

    /*Constants */
	const WEEKDAY_MONDAY = 1;
	const WEEKDAY_TUESDAY = 2;
	const WEEKDAY_WEDNESDAY = 3;
	const WEEKDAY_THURSDAY = 4;
	const WEEKDAY_FRIDAY = 5;
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set weekday
     *
     * @param integer $weekday
     * @return SubjectTimetable
     */
    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    
        return $this;
    }

    /**
     * Get weekday
     *
     * @return integer 
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Set beginTime
     *
     * @param \DateTime $beginTime
     * @return SubjectTimetable
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;
    
        return $this;
    }

    /**
     * Get beginTime
     *
     * @return \DateTime 
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * Set finishTime
     *
     * @param \DateTime $finishTime
     * @return SubjectTimetable
     */
    public function setFinishTime($finishTime)
    {
        $this->finishTime = $finishTime;
    
        return $this;
    }

    /**
     * Get finishTime
     *
     * @return \DateTime 
     */
    public function getFinishTime()
    {
        return $this->finishTime;
    }

    /**
     * Set subject
     *
     * @param \SanFidel\AdminBundle\Entity\Subject $subject
     * @return SubjectTimetable
     */
    public function setSubject(Hezten/CoreBundle/Entity/Subject $subject = null)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return \SanFidel\AdminBundle\Entity\Subject 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set beginDate
     *
     * @param \DateTime $beginDate
     * @return SubjectTimetable
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;
    
        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \DateTime 
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set finishDate
     *
     * @param \DateTime $finishDate
     * @return SubjectTimetable
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;
    
        return $this;
    }

    /**
     * Get finishDate
     *
     * @return \DateTime 
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }
}