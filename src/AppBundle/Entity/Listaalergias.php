<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Listaalergias
 *
 * @ORM\Table(name="listaAlergias", indexes={@ORM\Index(name="U_Lista", columns={"usuarioLA"}), @ORM\Index(name="A_Lista", columns={"alergiaLA"})})
 * @ORM\Entity
 */
class Listaalergias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idListaAlergia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlistaalergia;

    /**
     * @var \AppBundle\Entity\Alergia
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Alergia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alergiaLA", referencedColumnName="idAlergia")
     * })
     */
    private $alergiala;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuarioLA", referencedColumnName="idUsuario")
     * })
     */
    private $usuariola;



    /**
     * Get idlistaalergia
     *
     * @return integer 
     */
    public function getIdlistaalergia()
    {
        return $this->idlistaalergia;
    }

    /**
     * Set alergiala
     *
     * @param \AppBundle\Entity\Alergia $alergiala
     * @return Listaalergias
     */
    public function setAlergiala(\AppBundle\Entity\Alergia $alergiala = null)
    {
        $this->alergiala = $alergiala;

        return $this;
    }

    /**
     * Get alergiala
     *
     * @return \AppBundle\Entity\Alergia 
     */
    public function getAlergiala()
    {
        return $this->alergiala;
    }

    /**
     * Set usuariola
     *
     * @param \AppBundle\Entity\Usuario $usuariola
     * @return Listaalergias
     */
    public function setUsuariola(\AppBundle\Entity\Usuario $usuariola = null)
    {
        $this->usuariola = $usuariola;

        return $this;
    }

    /**
     * Get usuariola
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuariola()
    {
        return $this->usuariola;
    }
}
