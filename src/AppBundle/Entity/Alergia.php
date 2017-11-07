<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alergia
 *
 * @ORM\Table(name="alergia")
 * @ORM\Entity
 */
class Alergia
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreA", type="string", length=25, nullable=true)
     */
    private $nombrea;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAlergia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idalergia;



    /**
     * Set nombrea
     *
     * @param string $nombrea
     * @return Alergia
     */
    public function setNombrea($nombrea)
    {
        $this->nombrea = $nombrea;

        return $this;
    }

    /**
     * Get nombrea
     *
     * @return string 
     */
    public function getNombrea()
    {
        return $this->nombrea;
    }

    /**
     * Get idalergia
     *
     * @return integer 
     */
    public function getIdalergia()
    {
        return $this->idalergia;
    }
}
