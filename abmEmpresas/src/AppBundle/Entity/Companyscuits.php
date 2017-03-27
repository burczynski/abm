<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companyscuits
 *
 * @ORM\Table(name="companysCuits", indexes={@ORM\Index(name="company_id", columns={"company_id"})})
 * @ORM\Entity
 */
class Companyscuits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_cuit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $companyCuitId;

    /**
     * @var string
     *
     * @ORM\Column(name="company_Cuit_number", type="string", length=13, nullable=false)
     */
    private $companyCuitNumber;

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
     * Get companyCuitId
     *
     * @return integer 
     */
    public function getCompanyCuitId()
    {
        return $this->companyCuitId;
    }

    /**
     * Set companyCuitNumber
     *
     * @param string $companyCuitNumber
     * @return Companyscuits
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
     * Set company
     *
     * @param \AppBundle\Entity\Companys $company
     * @return Companyscuits
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
}
