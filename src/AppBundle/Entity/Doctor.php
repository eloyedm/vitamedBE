<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doctor
 *
 * @ORM\Table(name="doctor")
 * @ORM\Entity
 */
class Doctor
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreD", type="string", length=25, nullable=true)
     */
    private $nombred;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMD", type="string", length=25, nullable=true)
     */
    private $apellidomd;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPD", type="string", length=25, nullable=true)
     */
    private $apellidopd;

    /**
     * @var string
     *
     * @ORM\Column(name="especialidad", type="string", length=25, nullable=true)
     */
    private $especialidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDoctor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddoctor;

    /**
     * Set nombred
     *
     * @param string $nombred
     * @return Doctor
     */
    public function setNombred($nombred)
    {
        $this->nombred = $nombred;

        return $this;
    }

    /**
     * Get nombred
     *
     * @return string
     */
    public function getNombred()
    {
        return $this->nombred;
    }

    /**
     * Set apellidomd
     *
     * @param string $apellidomd
     * @return Doctor
     */
    public function setApellidomd($apellidomd)
    {
        $this->apellidomd = $apellidomd;

        return $this;
    }

    /**
     * Get apellidomd
     *
     * @return string
     */
    public function getApellidomd()
    {
        return $this->apellidomd;
    }

    /**
     * Set apellidopd
     *
     * @param string $apellidopd
     * @return Doctor
     */
    public function setApellidopd($apellidopd)
    {
        $this->apellidopd = $apellidopd;

        return $this;
    }

    /**
     * Get apellidopd
     *
     * @return string
     */
    public function getApellidopd()
    {
        return $this->apellidopd;
    }

    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get apellidopd
     *
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->$especialidad;
    }

    /**
     * Get iddoctor
     *
     * @return integer
     */
    public function getIddoctor()
    {
        return $this->iddoctor;
    }
}
