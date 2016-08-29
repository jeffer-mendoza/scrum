<?php

namespace ManagementBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Table(name="story")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\StoryRepository")
 */
class Story
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
     * @ORM\Column(name="want", type="string", length=255)
     */
    private $want;

    /**
     * @var string
     *
     * @ORM\Column(name="soThat", type="string", length=255)
     */
    private $soThat;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="smallint")
     */
    private $priority;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="effort", type="smallint")
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
     * @var \ManagementBundle\Entity\Sprint
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Sprint", inversedBy="stories")
     * @ORM\JoinColumn(name="sprint", referencedColumnName="id")
     */
    private $sprint;

    /**
     * @var \ManagementBundle\Entity\Activity
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Activity", inversedBy="stories")
     * @ORM\JoinColumn(name="activity", referencedColumnName="id")
     */
    private $activity;

    /**
     * @var \ManagementBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Project", inversedBy="stories")
     * @ORM\JoinColumn(name="project", referencedColumnName="id")
     */
    private $project;

    /**
     * @var \ManagementBundle\Entity\Story
     *
     * @ORM\OneToOne(targetEntity="\ManagementBundle\Entity\Story")
     * @ORM\JoinColumn(name="parentStory", referencedColumnName="id")
     */
    private $parentStory;

    /**
     * @var \ManagementBundle\Entity\Rol
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Rol", inversedBy="stories")
     * @ORM\JoinColumn(name="rol", referencedColumnName="id")
     */
    private $rol;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Task", mappedBy="story")
     */
    private $task;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Comment", mappedBy="story")
     */
    private $comments;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\SpendEffort", mappedBy="story")
     */
    private $spendEfforts;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\AcceptanceRequirement", mappedBy="story")
     */
    private $acceptanceRequirements;

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
     * Set want
     *
     * @param string $want
     * @return Story
     */
    public function setWant($want)
    {
        $this->want = $want;

        return $this;
    }

    /**
     * Get want
     *
     * @return string 
     */
    public function getWant()
    {
        return $this->want;
    }

    /**
     * Set soThat
     *
     * @param string $soThat
     * @return Story
     */
    public function setSoThat($soThat)
    {
        $this->soThat = $soThat;

        return $this;
    }

    /**
     * Get soThat
     *
     * @return string 
     */
    public function getSoThat()
    {
        return $this->soThat;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Story
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Story
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set effort
     *
     * @param integer $effort
     * @return Story
     */
    public function setEffort($effort)
    {
        $this->effort = $effort;

        return $this;
    }

    /**
     * Get effort
     *
     * @return integer 
     */
    public function getEffort()
    {
        return $this->effort;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Story
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
     * @return Story
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
     * Set sprint
     *
     * @param \stdClass $sprint
     * @return Story
     */
    public function setSprint($sprint)
    {
        $this->sprint = $sprint;

        return $this;
    }

    /**
     * Get sprint
     *
     * @return \stdClass 
     */
    public function getSprint()
    {
        return $this->sprint;
    }

    /**
     * Set activity
     *
     * @param \stdClass $activity
     * @return Story
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \stdClass 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set project
     *
     * @param \stdClass $project
     * @return Story
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \stdClass 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set parentStory
     *
     * @param \stdClass $parentStory
     * @return Story
     */
    public function setParentStory($parentStory)
    {
        $this->parentStory = $parentStory;

        return $this;
    }

    /**
     * Get parentStory
     *
     * @return \stdClass 
     */
    public function getParentStory()
    {
        return $this->parentStory;
    }

    /**
     * Set rol
     *
     * @param \stdClass $rol
     * @return Story
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \stdClass 
     */
    public function getRol()
    {
        return $this->rol;
    }

    function __toString()
    {
        return $this->want;
    }
}
