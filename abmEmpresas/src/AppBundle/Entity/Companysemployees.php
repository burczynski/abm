<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companysemployees
 *
 * @ORM\Table(name="companysEmployees", indexes={@ORM\Index(name="company_employye_status_id", columns={"company_employye_status_id", "company_id"}), @ORM\Index(name="company_id", columns={"company_id"}), @ORM\Index(name="IDX_5E09280DD44F2F3D", columns={"company_employye_status_id"})})
 * @ORM\Entity
 */
class Companysemployees
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_employee_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $companyEmployeeId;

    /**
     * @var string
     *
     * @ORM\Column(name="company_employee_name", type="string", length=20, nullable=false)
     */
    private $companyEmployeeName;

    /**
     * @var string
     *
     * @ORM\Column(name="company_employee_lastName", type="string", length=20, nullable=false)
     */
    private $companyEmployeeLastname;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_employee_dni", type="integer", nullable=false)
     */
    private $companyEmployeeDni;

    /**
     * @var \Companys
     *
     * @ORM\ManyToOne(targetEntity="Companys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     * })
     */
    private $company;

    /**
     * @var \Companysemployeesstatus
     *
     * @ORM\ManyToOne(targetEntity="Companysemployeesstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_employye_status_id", referencedColumnName="company_employee_status_id")
     * })
     */
    private $companyEmployyeStatus;



    /**
     * Get companyEmployeeId
     *
     * @return integer 
     */
    public function getCompanyEmployeeId()
    {
        return $this->companyEmployeeId;
    }

    /**
     * Set companyEmployeeName
     *
     * @param string $companyEmployeeName
     * @return Companysemployees
     */
    public function setCompanyEmployeeName($companyEmployeeName)
    {
        $this->companyEmployeeName = $companyEmployeeName;

        return $this;
    }

    /**
     * Get companyEmployeeName
     *
     * @return string 
     */
    public function getCompanyEmployeeName()
    {
        return $this->companyEmployeeName;
    }

    /**
     * Set companyEmployeeLastname
     *
     * @param string $companyEmployeeLastname
     * @return Companysemployees
     */
    public function setCompanyEmployeeLastname($companyEmployeeLastname)
    {
        $this->companyEmployeeLastname = $companyEmployeeLastname;

        return $this;
    }

    /**
     * Get companyEmployeeLastname
     *
     * @return string 
     */
    public function getCompanyEmployeeLastname()
    {
        return $this->companyEmployeeLastname;
    }

    /**
     * Set companyEmployeeDni
     *
     * @param integer $companyEmployeeDni
     * @return Companysemployees
     */
    public function setCompanyEmployeeDni($companyEmployeeDni)
    {
        $this->companyEmployeeDni = $companyEmployeeDni;

        return $this;
    }

    /**
     * Get companyEmployeeDni
     *
     * @return integer 
     */
    public function getCompanyEmployeeDni()
    {
        return $this->companyEmployeeDni;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Companys $company
     * @return Companysemployees
     */
    public function setCompany(\AppBundle\Entity\Companys $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Companys 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set companyEmployyeStatus
     *
     * @param \AppBundle\Entity\Companysemployeesstatus $companyEmployyeStatus
     * @return Companysemployees
     */
    public function setCompanyEmployyeStatus(\AppBundle\Entity\Companysemployeesstatus $companyEmployyeStatus = null)
    {
        $this->companyEmployyeStatus = $companyEmployyeStatus;

        return $this;
    }

    /**
     * Get companyEmployyeStatus
     *
     * @return \AppBundle\Entity\Companysemployeesstatus 
     */
    public function getCompanyEmployyeStatus()
    {
        return $this->companyEmployyeStatus;
    }
}
