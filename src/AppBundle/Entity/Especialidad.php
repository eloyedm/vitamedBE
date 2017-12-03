<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alergia
 *
 * @ORM\Table(name="especialidad")
 * @ORM\Entity
 */
class Especialidad
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreEs", type="string", length=25, nullable=true)
     */
    private $nombrees;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEspecialidad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idesp;



    /**
     * Set nombrea
     *
     * @param string $nombrea
     * @return Alergia
     */
    public function setNombrees($nombrees)
    {
        $this->$nombrees = $nombrees;

        return $this;
    }

    /**
     * Get nombrees
     *
     * @return string
     */
    public function getNombrees()
    {
        return $this->$nombrees;
    }

    /**
     * Get idespecialidad
     *
     * @return integer
     */
    public function getIdesp()
    {
        return $this->idesp;
    }
}
