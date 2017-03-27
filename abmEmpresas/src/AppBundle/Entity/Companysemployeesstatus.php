<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companysemployeesstatus
 *
 * @ORM\Table(name="companysEmployeesStatus")
 * @ORM\Entity
 */
class Companysemployeesstatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_employee_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $companyEmployeeStatusId;

    /**
     * @var string
     *
     * @ORM\Column(name="company_employee_status_name", type="string", length=20, nullable=false)
     */
    private $companyEmployeeStatusName;



    /**
     * Get companyEmployeeStatusId
     *
     * @return integer 
     */
    public function getCompanyEmployeeStatusId()
    {
        return $this->companyEmployeeStatusId;
    }

    /**
     * Set companyEmployeeStatusName
     *
     * @param string $companyEmployeeStatusName
     * @return Companysemployeesstatus
     */
    public function setCompanyEmployeeStatusName($companyEmployeeStatusName)
    {
        $this->companyEmployeeStatusName = $companyEmployeeStatusName;

        return $this;
    }

    /**
     * Get companyEmployeeStatusName
     *
     * @return string 
     */
    public function getCompanyEmployeeStatusName()
    {
        return $this->companyEmployeeStatusName;
    }
}
