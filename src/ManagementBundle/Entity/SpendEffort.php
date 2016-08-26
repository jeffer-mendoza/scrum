<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpendEffort
 *
 * @ORM\Table(name="spend_effort")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\SpendEffortRepository")
 */
class SpendEffort
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
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var int
     *
     * @ORM\Column(name="effort", type="smallint")
     */
    private $effort;

    /**
     * @var \ManagementBundle\Entity\Story
     *
     * @ORM\ManyToOne(targetEntity="\ManagementBundle\Entity\Story", inversedBy="spendEfforts")
     * @ORM\JoinColumn(name="story", referencedColumnName="id")
     */
    private $story;


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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return SpendEffort
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
     * Set effort
     *
     * @param integer $effort
     * @return SpendEffort
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
     * Set story
     *
     * @param \stdClass $story
     * @return SpendEffort
     */
    public function setStory($story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get story
     *
     * @return \stdClass 
     */
    public function getStory()
    {
        return $this->story;
    }
}
