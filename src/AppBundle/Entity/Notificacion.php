<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notificacion
 *
 * @ORM\Table(name="notificacion", indexes={@ORM\Index(name="C_Notificacion", columns={"citaN"})})
 * @ORM\Entity
 */
class Notificacion
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaN", type="date", nullable=true)
     */
    private $fechan;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaN", type="time", nullable=true)
     */
    private $horan;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajeN", type="string", length=45, nullable=true)
     */
    private $mensajen;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estatusN", type="boolean", nullable=true)
     */
    private $estatusn;

    /**
    *
    * @ORM\Column(type="tipo", type="integer", nullable=true)
    */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idNotificacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnotificacion;

    /**
     * @var \AppBundle\Entity\Cita
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="citaN", referencedColumnName="idCita")
     * })
     */
    private $citan;


    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuarioN", referencedColumnName="idUsuario")
     * })
     */
    private $usuarion;

    /**
     * @var \AppBundle\Entity\Consultorio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Consultorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consultorioN", referencedColumnName="idConsultorio")
     * })
     */
    private $consultorion;

    /**
     * Set fechan
     *
     * @param \DateTime $fechan
     * @return Notificacion
     */
    public function setFechan($fechan)
    {
        $this->fechan = $fechan;

        return $this;
    }

    /**
     * Get fechan
     *
     * @return \DateTime
     */
    public function getFechan()
    {
        return $this->fechan;
    }

    /**
     * Set horan
     *
     * @param \DateTime $horan
     * @return Notificacion
     */
    public function setHoran($horan)
    {
        $this->horan = $horan;

        return $this;
    }

    /**
     * Get horan
     *
     * @return \DateTime
     */
    public function getHoran()
    {
        return $this->horan;
    }

    public function setTipo($tipo){
      $this->tipo = $tipo;

      return $this;
    }

    public function getTipo(){
      return $this->tipo;
    }

    /**
     * Set mensajen
     *
     * @param string $mensajen
     * @return Notificacion
     */
    public function setMensajen($mensajen)
    {
        $this->mensajen = $mensajen;

        return $this;
    }

    /**
     * Get mensajen
     *
     * @return string
     */
    public function getMensajen()
    {
        return $this->mensajen;
    }

    /**
     * Set estatusn
     *
     * @param boolean $estatusn
     * @return Notificacion
     */
    public function setEstatusn($estatusn)
    {
        $this->estatusn = $estatusn;

        return $this;
    }

    /**
     * Get estatusn
     *
     * @return boolean
     */
    public function getEstatusn()
    {
        return $this->estatusn;
    }

    /**
     * Get idnotificacion
     *
     * @return integer
     */
    public function getIdnotificacion()
    {
        return $this->idnotificacion;
    }

    /**
     * Set citan
     *
     * @param \AppBundle\Entity\Cita $citan
     * @return Notificacion
     */
    public function setCitan(\AppBundle\Entity\Cita $citan = null)
    {
        $this->citan = $citan;

        return $this;
    }

    /**
     * Get citan
     *
     * @return \AppBundle\Entity\Cita
     */
    public function getCitan()
    {
        return $this->citan;
    }

    public function setUsuarion($usuarion)
    {
        $this->usuarion = $usuarion;

        return $this;
    }

    public function getUsuarion()
    {
        return $this->usuarion;
    }

    /**
     * Set consultorioc
     *
     * @param \AppBundle\Entity\Consultorio $consultorioc
     * @return Cita
     */
    public function setConsultorion(\AppBundle\Entity\Consultorio $consultorion)
    {
        $this->consultorion = $consultorion;

        return $this;
    }

    /**
     * Get consultorioc
     *
     * @return \AppBundle\Entity\Consultorio
     */
    public function getConsultorion()
    {
        return $this->consultorion;
    }
}
