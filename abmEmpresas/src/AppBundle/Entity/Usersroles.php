<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usersroles
 *
 * @ORM\Table(name="usersRoles")
 * @ORM\Entity
 */
class Usersroles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userRoleId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_role_name", type="string", length=35, nullable=false)
     */
    private $userRoleName;



    /**
     * Get userRoleId
     *
     * @return integer 
     */
    public function getUserRoleId()
    {
        return $this->userRoleId;
    }

    /**
     * Set userRoleName
     *
     * @param string $userRoleName
     * @return Usersroles
     */
    public function setUserRoleName($userRoleName)
    {
        $this->userRoleName = $userRoleName;

        return $this;
    }

    /**
     * Get userRoleName
     *
     * @return string 
     */
    public function getUserRoleName()
    {
        return $this->userRoleName;
    }
}
