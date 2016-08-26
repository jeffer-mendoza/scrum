<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @var \ManagementBundle\Entity\BusinessProcesses
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\BusinessProcesses", inversedBy="activities")
     * @ORM\JoinColumn(name="business_processes", referencedColumnName="id")
     */
    private $businessProcesses;


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
     * Set businessProcesses
     *
     * @param \stdClass $businessProcesses
     * @return Activity
     */
    public function setBusinessProcesses($businessProcesses)
    {
        $this->businessProcesses = $businessProcesses;

        return $this;
    }

    /**
     * Get businessProcesses
     *
     * @return \stdClass 
     */
    public function getBusinessProcesses()
    {
        return $this->businessProcesses;
    }
}
