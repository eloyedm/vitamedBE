<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doctor
 *
 * @ORM\Table(name="departamento")
 * @ORM\Entity
 */
class Departamento
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreDep", type="string", length=35, nullable=true)
     */
    private $nombredep;

    /**
     * @var \AppBundle\Entity\Doctor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Doctor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctordep", referencedColumnName="idDoctor")
     * })
     */
    private $doctordep;

    /**
     * @var \AppBundle\Entity\Consultorio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Consultorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consultoriodep", referencedColumnName="idConsultorio")
     * })
     */
    private $consultoriodep;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDepartamento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddep;



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

    /**
     * Set especialidad
     *
     * @param string $especialidad
     * @return Doctor
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
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
