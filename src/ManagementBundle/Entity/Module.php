<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\ActivityRepository")
 */
class Module
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
     * @var \ManagementBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Project", inversedBy="modules")
     * @ORM\JoinColumn(name="project", referencedColumnName="id")
     */
    private $project;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Story", mappedBy="project")
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
     * @return Activity
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
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }



    function __toString()
    {
        return $this->name.'';
    }


}
