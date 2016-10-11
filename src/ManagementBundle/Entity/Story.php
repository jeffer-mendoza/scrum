<?php

namespace ManagementBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ManagementBundle\ManagementBundle;

/**
 * Story
 *
 * @ORM\Table(name="story")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\StoryRepository")
 */
class Story
{
    //PRIORITY
    CONST HIGH = 5;
    CONST MIDDLE = 3;
    CONST LOW = 1;

    //STATUS
    CONST NONE = 0;
    CONST TODO = 1;
    CONST INPROGRESS = 2;
    CONST DONE = 3;
    CONST ACCEPT = 4;


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
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="want", type="string", length=255, nullable=false)
     */
    private $want;

    /**
     * @var string
     *
     * @ORM\Column(name="soThat", type="string", length=255, nullable=false)
     */
    private $soThat;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="smallint", nullable=true)
     */
    private $priority;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", nullable=true)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="effort", type="smallint", nullable=true)
     */
    private $effort;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="datetime", nullable=true)
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
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Task", mappedBy="story",cascade={"persist"})
     */
    private $tasks;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Comment", mappedBy="story",cascade={"persist"})
     */
    private $comments;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\SpendEffort", mappedBy="story",cascade={"persist"})
     */
    private $spendEfforts;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\AcceptanceRequirement", mappedBy="story",cascade={"persist"})
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * get priority like a string
     * @return string
     */
    public function strPriority()
    {
        if ($this->priority = Story::HIGH) {
            return "ALTA";
        } else {
            if ($this->priority = Story::MIDDLE) {
                return "MEDIA";
            } else {
                if ($this->priority = Story::LOW) {
                    return "BAJA";
                } else {
                    return "SIN PRIORIDAD";
                }
            }
        }
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
     * get priority like a string
     * @return string
     */
    public function strStatus()
    {
        if ($this->priority = Story::TODO) {
            return "PENDIENTE";
        } else {
            if ($this->priority = Story::INPROGRESS) {
                return "PROCESO";
            } else {
                if ($this->priority = Story::DONE) {
                    return "REALIZADA";
                } else {
                    if ($this->priority = Story::ACCEPT) {
                        return "ACEPTADA";
                    } else {
                        return "None";
                    }
                }
            }
        }
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
     * @param \ManagementBundle\Entity\Sprint $sprint
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
     * @return \ManagementBundle\Entity\Sprint
     */
    public function getSprint()
    {
        return $this->sprint;
    }

    /**
     * Set activity
     *
     * @param \ManagementBundle\Entity\Activity $activity
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
     * @return \ManagementBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set project
     *
     * @param \ManagementBundle\Entity\Project $project
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
     * @return \ManagementBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set parentStory
     *
     * @param Story $parentStory
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
     * @return Story
     */
    public function getParentStory()
    {
        return $this->parentStory;
    }

    /**
     * Set rol
     *
     * @param \ManagementBundle\Entity\Rol $rol
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
     * @return \ManagementBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    function __toString()
    {
        return $this->want;
    }

    /**
     * @return ArrayCollection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param ArrayCollection $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return ArrayCollection
     */
    public function getSpendEfforts()
    {
        return $this->spendEfforts;
    }

    /**
     * @param ArrayCollection $spendEfforts
     */
    public function setSpendEfforts($spendEfforts)
    {
        $this->spendEfforts = $spendEfforts;
    }

    /**
     * @return ArrayCollection
     */
    public function getAcceptanceRequirements()
    {
        return $this->acceptanceRequirements;
    }

    /**
     * @param ArrayCollection $acceptanceRequirements
     */
    public function setAcceptanceRequirements($acceptanceRequirements)
    {
        $this->acceptanceRequirements = $acceptanceRequirements;
    }

    /**
     * add an Acceptance Requirement
     * @param AcceptanceRequirement $acceptanceRequirement
     * @return $this
     */
    public function addAcceptanceRequirement(AcceptanceRequirement $acceptanceRequirement){
        $this->acceptanceRequirements[] = $acceptanceRequirement;

        return $this;
    }

    /**
     * add a task
     * @param Task $task
     * @return $this
     */
    public function addTask(Task $task){
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * add a spend effort
     * @param SpendEffort $spendEffort
     * @return $this
     */
    public function addspendEffort(SpendEffort $spendEffort){
        $this->spendEfforts[] = $spendEffort;

        return $this;
    }

    /**
     * add a spend effort
     * @param Comment $comment
     * @return $this
     */
    public function addComment(Comment $comment){
        $this->comments[] = $comment;

        return $this;
    }



}
