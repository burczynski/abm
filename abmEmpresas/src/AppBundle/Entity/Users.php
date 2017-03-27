<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="user_role_id", columns={"user_role_id", "user_permission_id"}), @ORM\Index(name="user_permission_id", columns={"user_permission_id"}), @ORM\Index(name="user_status_id", columns={"user_status_id"}), @ORM\Index(name="IDX_1483A5E98E0E3CA6", columns={"user_role_id"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_user", type="string", length=40, nullable=false)
     */
    private $userUser;

    /**
     * @var string
     *
     * @ORM\Column(name="user_pass", type="string", length=40, nullable=false)
     */
    private $userPass;

    /**
     * @var \Usersstatus
     *
     * @ORM\ManyToOne(targetEntity="Usersstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_status_id", referencedColumnName="user_status_id")
     * })
     */
    private $userStatus;

    /**
     * @var \Usersroles
     *
     * @ORM\ManyToOne(targetEntity="Usersroles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_role_id", referencedColumnName="user_role_id")
     * })
     */
    private $userRole;

    /**
     * @var \Userspermissions
     *
     * @ORM\ManyToOne(targetEntity="Userspermissions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_permission_id", referencedColumnName="user_permission_id")
     * })
     */
    private $userPermission;



    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userUser
     *
     * @param string $userUser
     * @return Users
     */
    public function setUserUser($userUser)
    {
        $this->userUser = $userUser;

        return $this;
    }

    /**
     * Get userUser
     *
     * @return string 
     */
    public function getUserUser()
    {
        return $this->userUser;
    }

    /**
     * Set userPass
     *
     * @param string $userPass
     * @return Users
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get userPass
     *
     * @return string 
     */
    public function getUserPass()
    {
        return $this->userPass;
    }

    /**
     * Set userStatus
     *
     * @param \AppBundle\Entity\Usersstatus $userStatus
     * @return Users
     */
    public function setUserStatus(\AppBundle\Entity\Usersstatus $userStatus = null)
    {
        $this->userStatus = $userStatus;

        return $this;
    }

    /**
     * Get userStatus
     *
     * @return \AppBundle\Entity\Usersstatus 
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * Set userRole
     *
     * @param \AppBundle\Entity\Usersroles $userRole
     * @return Users
     */
    public function setUserRole(\AppBundle\Entity\Usersroles $userRole = null)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return \AppBundle\Entity\Usersroles 
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set userPermission
     *
     * @param \AppBundle\Entity\Userspermissions $userPermission
     * @return Users
     */
    public function setUserPermission(\AppBundle\Entity\Userspermissions $userPermission = null)
    {
        $this->userPermission = $userPermission;

        return $this;
    }

    /**
     * Get userPermission
     *
     * @return \AppBundle\Entity\Userspermissions 
     */
    public function getUserPermission()
    {
        return $this->userPermission;
    }
}
