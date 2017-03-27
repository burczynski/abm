<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userspermissions
 *
 * @ORM\Table(name="usersPermissions")
 * @ORM\Entity
 */
class Userspermissions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_permission_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userPermissionId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_permission_name", type="string", length=35, nullable=false)
     */
    private $userPermissionName;



    /**
     * Get userPermissionId
     *
     * @return integer 
     */
    public function getUserPermissionId()
    {
        return $this->userPermissionId;
    }

    /**
     * Set userPermissionName
     *
     * @param string $userPermissionName
     * @return Userspermissions
     */
    public function setUserPermissionName($userPermissionName)
    {
        $this->userPermissionName = $userPermissionName;

        return $this;
    }

    /**
     * Get userPermissionName
     *
     * @return string 
     */
    public function getUserPermissionName()
    {
        return $this->userPermissionName;
    }
}
