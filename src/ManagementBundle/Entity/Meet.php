<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meet
 *
 * @ORM\Table(name="meet")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\MeetRepository")
 */
class Meet
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=1000)
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\Column(name="decisions", type="string", length=1000)
     */
    private $decisions;


    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=1000)
     */
    private $detail;


    /**
     * Set detail
     *
     * @param string $detail
     * @return Meet
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param string $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return string
     */
    public function getDecisions()
    {
        return $this->decisions;
    }

    /**
     * @param string $decisions
     */
    public function setDecisions($decisions)
    {
        $this->decisions = $decisions;
    }

}

