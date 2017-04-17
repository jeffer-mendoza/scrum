<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcceptanceRequirement
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\Test")
 */
class Test
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
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prerequisite", type="string", length=9999)
     */
    private $prerequisite;

    /**
     * @var string
     *
     * @ORM\Column(name="steps", type="string", length=9999)
     */
    private $steps;

    /**
     * @var string
     *
     * @ORM\Column(name="expected", type="string", length=5000)
     */
    private $expected;

    /**
     * @var string
     *
     * @ORM\Column(name="obtained", type="string", length=5000)
     */
    private $obtained;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="automated", type="boolean", nullable=true)
     */
    private $automated = false;

    /**
     * @var \ManagementBundle\Entity\Story
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Story", inversedBy="tests")
     * @ORM\JoinColumn(name="story", referencedColumnName="id")
     */
    private $story;

    /**
     * @var \ManagementBundle\Entity\AcceptanceRequirement
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\AcceptanceRequirement", inversedBy="tests")
     * @ORM\JoinColumn(name="acceptance_requirement", referencedColumnName="id")
     */
    private $acceptance_requirement;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPrerequisite()
    {
        return $this->prerequisite;
    }

    /**
     * @param string $prerequisite
     */
    public function setPrerequisite($prerequisite)
    {
        $this->prerequisite = $prerequisite;
    }

    /**
     * @return string
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param string $steps
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return string
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * @param string $expected
     */
    public function setExpected($expected)
    {
        $this->expected = $expected;
    }

    /**
     * @return string
     */
    public function getObtained()
    {
        return $this->obtained;
    }

    /**
     * @param string $obtained
     */
    public function setObtained($obtained)
    {
        $this->obtained = $obtained;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isAutomated()
    {
        return $this->automated;
    }

    /**
     * @param bool $automated
     */
    public function setAutomated($automated)
    {
        $this->automated = $automated;
    }

    /**
     * @return Story
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param Story $story
     */
    public function setStory($story)
    {
        $this->story = $story;
    }

    /**
     * @return AcceptanceRequirement
     */
    public function getAcceptanceRequirement()
    {
        return $this->acceptance_requirement;
    }

    /**
     * @param AcceptanceRequirement $acceptance_requirement
     */
    public function setAcceptanceRequirement($acceptance_requirement)
    {
        $this->acceptance_requirement = $acceptance_requirement;
    }

}
