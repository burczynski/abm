<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usersstatus
 *
 * @ORM\Table(name="usersStatus")
 * @ORM\Entity
 */
class Usersstatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userStatusId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_status_name", type="string", length=40, nullable=false)
     */
    private $userStatusName;



    /**
     * Get userStatusId
     *
     * @return integer 
     */
    public function getUserStatusId()
    {
        return $this->userStatusId;
    }

    /**
     * Set userStatusName
     *
     * @param string $userStatusName
     * @return Usersstatus
     */
    public function setUserStatusName($userStatusName)
    {
        $this->userStatusName = $userStatusName;

        return $this;
    }

    /**
     * Get userStatusName
     *
     * @return string 
     */
    public function getUserStatusName()
    {
        return $this->userStatusName;
    }
}
