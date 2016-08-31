<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Story", mappedBy="project", cascade={"all"}, fetch="EAGER")
     */
    private $stories;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Sprint", mappedBy="project")
     */
    private $sprints;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Rol", mappedBy="project")
     */
    private $roles;
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
     * @return Project
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
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Project
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
     * @return Project
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

    function __toString()
    {
        return $this->name;
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
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSprints()
    {
        return $this->sprints;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $sprints
     */
    public function setSprints($sprints)
    {
        $this->sprints = $sprints;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }





}
