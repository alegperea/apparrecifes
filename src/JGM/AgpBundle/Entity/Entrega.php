<?php

namespace JGM\AgpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * JGM\AgpBundle\Entity\Entrega
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JGM\AgpBundle\Entity\EntregaRepository")
 */
class Entrega {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="date", length=255)
     * @Assert\NotBlank(message="La fecha no puede estar en blanco")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="JGM\AgpBundle\Entity\Cliente")
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="JGM\AgpBundle\Entity\ProductoEntregaReference", mappedBy="entrega", cascade={"persist", "remove"})
     */
    private $productos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="descuento_especial", type="boolean", nullable=true)
     */
    private $descuentoEspecial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pago_realizado", type="boolean", nullable=true)
     */
    private $pagoRealizado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="limpieza_realizada", type="boolean", nullable=true)
     */
    private $limpiezaRealizada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cambio_c02", type="boolean", nullable=true)
     */
    private $cambioCo2;
    
    

    function getId() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getProductos() {
        return $this->productos;
    }

    public function getDescuentoEspecial() {
        return $this->descuentoEspecial;
    }

    public function getPagoRealizado() {
        return $this->pagoRealizado;
    }

    public function getLimpiezaRealizada() {
        return $this->limpiezaRealizada;
    }

    public function getCambioCo2() {
        return $this->cambioCo2;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setProductos($productos) {
        $this->productos = $productos;
    }

    public function setDescuentoEspecial($descuentoEspecial) {
        $this->descuentoEspecial = $descuentoEspecial;
    }

    public function setPagoRealizado($pagoRealizado) {
        $this->pagoRealizado = $pagoRealizado;
    }

    public function setLimpiezaRealizada($limpiezaRealizada) {
        $this->limpiezaRealizada = $limpiezaRealizada;
    }

    public function setCambioCo2($cambioCo2) {
        $this->cambioCo2 = $cambioCo2;
    }

}
