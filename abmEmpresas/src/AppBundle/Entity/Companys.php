<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companys
 *
 * @ORM\Table(name="companys", indexes={@ORM\Index(name="company_status_id", columns={"company_status_id"})})
 * @ORM\Entity
 */
class Companys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $companyId;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=50, nullable=false)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="company_Cuit_number", type="string", length=13, nullable=false)
     */
    private $companyCuitNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_total_employees", type="integer", nullable=false)
     */
    private $companyTotalEmployees;

    /**
     * @var \Companysstatus
     *
     * @ORM\ManyToOne(targetEntity="Companysstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_status_id", referencedColumnName="company_status_id")
     * })
     */
    private $companyStatus;



    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Companys
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyCuitNumber
     *
     * @param string $companyCuitNumber
     * @return Companys
     */
    public function setCompanyCuitNumber($companyCuitNumber)
    {
        $this->companyCuitNumber = $companyCuitNumber;

        return $this;
    }

    /**
     * Get companyCuitNumber
     *
     * @return string 
     */
    public function getCompanyCuitNumber()
    {
        return $this->companyCuitNumber;
    }

    /**
     * Set companyTotalEmployees
     *
     * @param integer $companyTotalEmployees
     * @return Companys
     */
    public function setCompanyTotalEmployees($companyTotalEmployees)
    {
        $this->companyTotalEmployees = $companyTotalEmployees;

        return $this;
    }

    /**
     * Get companyTotalEmployees
     *
     * @return integer 
     */
    public function getCompanyTotalEmployees()
    {
        return $this->companyTotalEmployees;
    }

    /**
     * Set companyStatus
     *
     * @param \AppBundle\Entity\Companysstatus $companyStatus
     * @return Companys
     */
    public function setCompanyStatus(\AppBundle\Entity\Companysstatus $companyStatus = null)
    {
        $this->companyStatus = $companyStatus;

        return $this;
    }

    /**
     * Get companyStatus
     *
     * @return \AppBundle\Entity\Companysstatus 
     */
    public function getCompanyStatus()
    {
        return $this->companyStatus;
    }
}
