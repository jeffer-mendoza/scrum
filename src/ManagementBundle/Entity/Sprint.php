<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sprint
 *
 * @ORM\Table(name="sprint")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\SprintRepository")
 */
class Sprint
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="smallint", nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="objective", type="string", length=1000, nullable=true)
     */
    private $objective;

    /**
     * @var int
     *
     * @ORM\Column(name="effort", type="smallint", nullable=true)
     */
    private $effort;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="datetime")
     */
    private $dueDate;

    /**
     * @var \ManagementBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Project", inversedBy="sprints")
     * @ORM\JoinColumn(name="project", referencedColumnName="id")
     */
    private $project;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Story", mappedBy="sprint")
     */
    private $stories;


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
     * Set name
     *
     * @param string $name
     * @return Sprint
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Sprint
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Sprint
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set project
     *
     * @param \ManagementBundle\Entity\Project $project
     * @return Sprint
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \ManagementBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getStories()
    {
        return $this->stories;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $stories
     */
    public function setStories($stories)
    {
        $this->stories = $stories;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getObjective()
    {
        return $this->objective;
    }

    /**
     * @param string $objective
     */
    public function setObjective($objective)
    {
        $this->objective = $objective;
    }

    /**
     * @return int
     */
    public function getEffort()
    {
        return $this->effort;
    }

    /**
     * @param $effort
     */
    public function setEffort($effort)
    {
        $this->effort = $effort;
    }


    function __toString()
    {
       return $this->name;
    }

    /**
     *
     */
    function getBurndown(){
        $array = array();
        $effortTotal = 0;
        $arrayControl = array_fill(0,count($this->stories),0);//permite conocer que esfuerzos ya se habian agregado
        foreach ($this->stories as $story){
            $effortTotal += $story->getEffort();
        }
        foreach ($this->stories as $story) {
            foreach ($story->getSpendEfforts() as $effort){
                //$array[$this->startDate - $effort->getDate()] += $effort->getEffort();
                $x = $this->startDate->diff($effort->getDate())->format('%a');
                $y = $effortTotal - $effort->getEffort();

                $array []= array (
                    'x' => $x,
                    'y' => $y,
                );
                $effortTotal = $y;
            }

        }

        return $array;
    }


}
