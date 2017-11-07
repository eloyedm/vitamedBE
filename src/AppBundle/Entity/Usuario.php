<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="sangreU", type="string", length=5, nullable=true)
     */
    private $sangreu;

    /**
     * @var string
     *
     * @ORM\Column(name="fotoU", type="blob", length=65535, nullable=true)
     */
    private $fotou;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreU", type="string", length=25, nullable=true)
     */
    private $nombreu;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoU", type="string", length=25, nullable=true)
     */
    private $telefonou;

    /**
     * @var binary
     *
     * @ORM\Column(name="contraU", type="string", length=255, nullable=false)
     */
    private $contrau;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMU", type="string", length=25, nullable=true)
     */
    private $apellidomu;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPU", type="string", length=25, nullable=true)
     */
    private $apellidopu;

    /**
     * @var string
     *
     * @ORM\Column(name="calleU", type="string", length=25, nullable=true)
     */
    private $calleu;

    /**
     * @var string
     *
     * @ORM\Column(name="correoU", type="string", length=50, nullable=true)
     */
    private $correou;

    /**
     * @var string
     *
     * @ORM\Column(name="coloniaU", type="string", length=25, nullable=true)
     */
    private $coloniau;

    /**
     * @var string
     *
     * @ORM\Column(name="noCasaU", type="string", length=10, nullable=true)
     */
    private $nocasau;

    /**
     * @var string
     *
     * @ORM\Column(name="paisU", type="string", length=25, nullable=true)
     */
    private $paisu;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=25, nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;



    /**
     * Set sangreu
     *
     * @param string $sangreu
     * @return Usuario
     */
    public function setSangreu($sangreu)
    {
        $this->sangreu = $sangreu;

        return $this;
    }

    /**
     * Get sangreu
     *
     * @return string 
     */
    public function getSangreu()
    {
        return $this->sangreu;
    }

    /**
     * Set fotou
     *
     * @param string $fotou
     * @return Usuario
     */
    public function setFotou($fotou)
    {
        $this->fotou = $fotou;

        return $this;
    }

    /**
     * Get fotou
     *
     * @return string 
     */
    public function getFotou()
    {
        return $this->fotou;
    }

    /**
     * Set nombreu
     *
     * @param string $nombreu
     * @return Usuario
     */
    public function setNombreu($nombreu)
    {
        $this->nombreu = $nombreu;

        return $this;
    }

    /**
     * Get nombreu
     *
     * @return string 
     */
    public function getNombreu()
    {
        return $this->nombreu;
    }

    /**
     * Set telefonou
     *
     * @param string $telefonou
     * @return Usuario
     */
    public function setTelefonou($telefonou)
    {
        $this->telefonou = $telefonou;

        return $this;
    }

    /**
     * Get telefonou
     *
     * @return string 
     */
    public function getTelefonou()
    {
        return $this->telefonou;
    }

    /**
     * Set contrau
     *
     * @param binary $contrau
     * @return Usuario
     */
    public function setContrau($contrau)
    {
        $this->contrau = $contrau;

        return $this;
    }

    /**
     * Get contrau
     *
     * @return binary 
     */
    public function getContrau()
    {
        return $this->contrau;
    }

    /**
     * Set apellidomu
     *
     * @param string $apellidomu
     * @return Usuario
     */
    public function setApellidomu($apellidomu)
    {
        $this->apellidomu = $apellidomu;

        return $this;
    }

    /**
     * Get apellidomu
     *
     * @return string 
     */
    public function getApellidomu()
    {
        return $this->apellidomu;
    }

    /**
     * Set apellidopu
     *
     * @param string $apellidopu
     * @return Usuario
     */
    public function setApellidopu($apellidopu)
    {
        $this->apellidopu = $apellidopu;

        return $this;
    }

    /**
     * Get apellidopu
     *
     * @return string 
     */
    public function getApellidopu()
    {
        return $this->apellidopu;
    }

    /**
     * Set calleu
     *
     * @param string $calleu
     * @return Usuario
     */
    public function setCalleu($calleu)
    {
        $this->calleu = $calleu;

        return $this;
    }

    /**
     * Get calleu
     *
     * @return string 
     */
    public function getCalleu()
    {
        return $this->calleu;
    }

    /**
     * Set correou
     *
     * @param string $correou
     * @return Usuario
     */
    public function setCorreou($correou)
    {
        $this->correou = $correou;

        return $this;
    }

    /**
     * Get correou
     *
     * @return string 
     */
    public function getCorreou()
    {
        return $this->correou;
    }

    /**
     * Set coloniau
     *
     * @param string $coloniau
     * @return Usuario
     */
    public function setColoniau($coloniau)
    {
        $this->coloniau = $coloniau;

        return $this;
    }

    /**
     * Get coloniau
     *
     * @return string 
     */
    public function getColoniau()
    {
        return $this->coloniau;
    }

    /**
     * Set nocasau
     *
     * @param string $nocasau
     * @return Usuario
     */
    public function setNocasau($nocasau)
    {
        $this->nocasau = $nocasau;

        return $this;
    }

    /**
     * Get nocasau
     *
     * @return string 
     */
    public function getNocasau()
    {
        return $this->nocasau;
    }

    /**
     * Set paisu
     *
     * @param string $paisu
     * @return Usuario
     */
    public function setPaisu($paisu)
    {
        $this->paisu = $paisu;

        return $this;
    }

    /**
     * Get paisu
     *
     * @return string 
     */
    public function getPaisu()
    {
        return $this->paisu;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Usuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get idusuario
     *
     * @return integer 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
