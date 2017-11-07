<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cita
 *
 * @ORM\Table(name="cita", indexes={@ORM\Index(name="C_Cita", columns={"consultorioC"})})
 * @ORM\Entity
 */
class Cita
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaC", type="date", nullable=true)
     */
    private $fechac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaC", type="time", nullable=true)
     */
    private $horac;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estatusC", type="boolean", nullable=true)
     */
    private $estatusc;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajeC", type="string", length=25, nullable=true)
     */
    private $mensajec;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCita", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcita;

    /**
     * @var \AppBundle\Entity\Consultorio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Consultorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consultorioC", referencedColumnName="idConsultorio")
     * })
     */
    private $consultorioc;



    /**
     * Set fechac
     *
     * @param \DateTime $fechac
     * @return Cita
     */
    public function setFechac($fechac)
    {
        $this->fechac = $fechac;

        return $this;
    }

    /**
     * Get fechac
     *
     * @return \DateTime 
     */
    public function getFechac()
    {
        return $this->fechac;
    }

    /**
     * Set horac
     *
     * @param \DateTime $horac
     * @return Cita
     */
    public function setHorac($horac)
    {
        $this->horac = $horac;

        return $this;
    }

    /**
     * Get horac
     *
     * @return \DateTime 
     */
    public function getHorac()
    {
        return $this->horac;
    }

    /**
     * Set estatusc
     *
     * @param boolean $estatusc
     * @return Cita
     */
    public function setEstatusc($estatusc)
    {
        $this->estatusc = $estatusc;

        return $this;
    }

    /**
     * Get estatusc
     *
     * @return boolean 
     */
    public function getEstatusc()
    {
        return $this->estatusc;
    }

    /**
     * Set mensajec
     *
     * @param string $mensajec
     * @return Cita
     */
    public function setMensajec($mensajec)
    {
        $this->mensajec = $mensajec;

        return $this;
    }

    /**
     * Get mensajec
     *
     * @return string 
     */
    public function getMensajec()
    {
        return $this->mensajec;
    }

    /**
     * Get idcita
     *
     * @return integer 
     */
    public function getIdcita()
    {
        return $this->idcita;
    }

    /**
     * Set consultorioc
     *
     * @param \AppBundle\Entity\Consultorio $consultorioc
     * @return Cita
     */
    public function setConsultorioc(\AppBundle\Entity\Consultorio $consultorioc = null)
    {
        $this->consultorioc = $consultorioc;

        return $this;
    }

    /**
     * Get consultorioc
     *
     * @return \AppBundle\Entity\Consultorio 
     */
    public function getConsultorioc()
    {
        return $this->consultorioc;
    }
}
