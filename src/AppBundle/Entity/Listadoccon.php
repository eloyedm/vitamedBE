<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Listadoccon
 *
 * @ORM\Table(name="listaDocCon", indexes={@ORM\Index(name="D_ListaDC", columns={"doctorLCD"}), @ORM\Index(name="C_ListaDC", columns={"consultorioLCD"})})
 * @ORM\Entity
 */
class Listadoccon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idListaDocCon", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlistadoccon;

    /**
     * @var \AppBundle\Entity\Consultorio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Consultorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consultorioLCD", referencedColumnName="idConsultorio")
     * })
     */
    private $consultoriolcd;

    /**
     * @var \AppBundle\Entity\Doctor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Doctor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctorLCD", referencedColumnName="idDoctor")
     * })
     */
    private $doctorlcd;



    /**
     * Get idlistadoccon
     *
     * @return integer 
     */
    public function getIdlistadoccon()
    {
        return $this->idlistadoccon;
    }

    /**
     * Set consultoriolcd
     *
     * @param \AppBundle\Entity\Consultorio $consultoriolcd
     * @return Listadoccon
     */
    public function setConsultoriolcd(\AppBundle\Entity\Consultorio $consultoriolcd = null)
    {
        $this->consultoriolcd = $consultoriolcd;

        return $this;
    }

    /**
     * Get consultoriolcd
     *
     * @return \AppBundle\Entity\Consultorio 
     */
    public function getConsultoriolcd()
    {
        return $this->consultoriolcd;
    }

    /**
     * Set doctorlcd
     *
     * @param \AppBundle\Entity\Doctor $doctorlcd
     * @return Listadoccon
     */
    public function setDoctorlcd(\AppBundle\Entity\Doctor $doctorlcd = null)
    {
        $this->doctorlcd = $doctorlcd;

        return $this;
    }

    /**
     * Get doctorlcd
     *
     * @return \AppBundle\Entity\Doctor 
     */
    public function getDoctorlcd()
    {
        return $this->doctorlcd;
    }
}
