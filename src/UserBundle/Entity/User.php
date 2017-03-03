<?php

/**
 * Encargado de todos los usuarios del sistema, incluyendo administradores, visualizadores, encargados
 * y registro académico
 *
 * @author Jorge Villada <jefferson.mendoza@correounivalle.edu.co>
 */

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     * @ORM\Column(name="direccion_ip", type="string", length=19, nullable=true)
     */
    private $direccionIp;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\ManagementBundle\Entity\UserProject", mappedBy="user")
     */
    private $projects;

    public function getEmail()
    {
        return parent::getEmail();
    }

    public function getPassword()
    {
        return parent::getPassword();
    }

    public function getRoles()
    {
        return parent::getRoles();
    }

    public function strRoles(){

        return implode(',',$this->roles);
    }

    public function setUsername($username)
    {
        $this->usernameCanonical = $username;
        return parent::setUsername($username);
    }

    public function setEmail($email)
    {
        $this->emailCanonical = $email;
        $this->enabled = true;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        return parent::setEmail($email);
    }

    public function setPassword($password)
    {
        return parent::setPassword($password);
    }

    public function setRoles(array $roles)
    {
        return parent::setRoles($roles);
    }


    function __construct()
    {
        parent::__construct();
//        $this->observaciones = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
    public function getDireccionIp()
    {
        return $this->direccionIp;
    }

    /**
     * @param string $direccionIp
     */
    public function setDireccionIp($direccionIp)
    {
        $this->direccionIp = $direccionIp;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function strFechaUltimoLogueo()
    {
        if ($this->getLastLogin() == NULL) {
            return "--";
        }
        return $this->getLastLogin()->format('d-M-Y H:i:s');
    }

    /**
     *
     */
    public function removeSinRole(){
        $resultado = array();
        foreach ($this->roles as $role){
            if($role != '0'){
             $resultado[] = $role;
            }
        }

        $this->roles = $resultado;

        return true;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $projects
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }



}
