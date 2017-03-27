<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companysstatus
 *
 * @ORM\Table(name="companysStatus")
 * @ORM\Entity
 */
class Companysstatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $companyStatusId;

    /**
     * @var string
     *
     * @ORM\Column(name="company_status_name", type="string", length=40, nullable=false)
     */
    private $companyStatusName;



    /**
     * Get companyStatusId
     *
     * @return integer 
     */
    public function getCompanyStatusId()
    {
        return $this->companyStatusId;
    }

    /**
     * Set companyStatusName
     *
     * @param string $companyStatusName
     * @return Companysstatus
     */
    public function setCompanyStatusName($companyStatusName)
    {
        $this->companyStatusName = $companyStatusName;

        return $this;
    }

    /**
     * Get companyStatusName
     *
     * @return string 
     */
    public function getCompanyStatusName()
    {
        return $this->companyStatusName;
    }
}
