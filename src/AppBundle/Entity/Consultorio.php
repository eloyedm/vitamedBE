<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultorio
 *
 * @ORM\Table(name="consultorio")
 * @ORM\Entity
 */
class Consultorio
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreCon", type="string", length=25, nullable=true)
     */
    private $nombrecon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEspecialidad", type="boolean", nullable=true)
     */
    private $isespecialidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idConsultorio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconsultorio;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Doctor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctorc", referencedColumnName="idDoctor")
     * })
     */
    private $doctorc;

    /**
     * Set nombrecon
     *
     * @param string $nombrecon
     * @return Consultorio
     */
    public function setNombrecon($nombrecon)
    {
        $this->nombrecon = $nombrecon;

        return $this;
    }

    /**
     * Get nombrecon
     *
     * @return string
     */
    public function getNombrecon()
    {
        return $this->nombrecon;
    }

    /**
     * Get idconsultorio
     *
     * @return integer
     */
    public function getIdconsultorio()
    {
        return $this->idconsultorio;
    }

    /**
     * Set consultorioc
     *
     * @param \AppBundle\Entity\Consultorio $consultorioc
     * @return Cita
     */
    public function setDoctorc(\AppBundle\Entity\Doctor $doctorc = null)
    {
        $this->doctorc = $doctorc;

        return $this;
    }

    /**
     * Get consultorioc
     *
     * @return \AppBundle\Entity\Consultorio
     */
    public function getDoctorc()
    {
        return $this->doctorc;
    }

    public function getIsEspecialidad()
    {
      return $this->isEspecialidad;
    }

    public function setIsEspecialidad($isEspecialidad)
    {
      $this->isEspecialidad = $isEspecialidad;

      return $this;
    }
}
