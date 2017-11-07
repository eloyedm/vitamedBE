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
     * @var integer
     *
     * @ORM\Column(name="idConsultorio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconsultorio;



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
}
