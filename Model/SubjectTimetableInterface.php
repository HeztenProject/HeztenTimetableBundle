<?php 

namespace Hezten\HeztenTimetableBundle\Model;

/**
*	SubjectTimetable model
*/
interface SubjectTimetableInterface
{
	/**
	*	Returns the id of the subject timetable item
	*
	*	@return integer
	*/
	public function getId();
	
    /**
     * Get weekday from monday(0) to sunday(7) 
     *
     * @return integer 
     */
    public function getWeekday();
    

    /**
     * Get beginTime
     *
     * @return \DateTime 
     */
    public function getBeginTime();

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
     * Get finishDate
     *
     * @return \DateTime 
     */
    public function getFinishDate();

    /**
     * Get subject
     *
     * @return Subject 
     */
    public function getSubject(Hezten/CoreBundle/Entity/Subject $subject = null);

}