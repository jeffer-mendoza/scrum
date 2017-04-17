<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcceptanceRequirement
 *
 * @ORM\Table(name="acceptance_requirement")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\AcceptanceRequirementRepository")
 */
class AcceptanceRequirement
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
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="acceptance", type="boolean", nullable=true)
     */
    private $acceptance = false;

    /**
     * @var \ManagementBundle\Entity\Story
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Story", inversedBy="acceptanceRequirements")
     * @ORM\JoinColumn(name="story", referencedColumnName="id")
     */
    private $story;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\Test", mappedBy="story",cascade={"persist"})
     */
    private $tests;


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
     * Set description
     *
     * @param string $description
     * @return AcceptanceRequirement
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
     * Set acceptance
     *
     * @param boolean $acceptance
     * @return AcceptanceRequirement
     */
    public function setAcceptance($acceptance)
    {
        $this->acceptance = $acceptance;

        return $this;
    }

    /**
     * Get acceptance
     *
     * @return boolean
     */
    public function getAcceptance()
    {
        return $this->acceptance;
    }

    /**
     * Get acceptance like stirng
     *
     * @return string
     */
    public function strAcceptance()
    {
        if ($this->acceptance) {
            return "ACEPTADO";
        } else {
            return "NO ACEPTADO";
        }
    }

    /**
     * Set story
     *
     * @param \ManagementBundle\Entity\Story $story
     * @return AcceptanceRequirement
     */
    public function setStory($story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get story
     *
     * @return \ManagementBundle\Entity\Story
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $tests
     */
    public function setTests($tests)
    {
        $this->tests = $tests;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

}
