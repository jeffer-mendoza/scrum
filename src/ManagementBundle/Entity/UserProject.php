<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="user_project")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\RolRepository")
 */
class UserProject
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
     * @var \ManagementBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Project", inversedBy="roles")
     * @ORM\JoinColumn(name="project", referencedColumnName="id")
     */
    private $project;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;



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
     * @return Rol
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
     * Set project
     *
     * @param \stdClass $project
     * @return Rol
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
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}
