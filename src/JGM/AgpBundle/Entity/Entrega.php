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
    * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
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
     *
     * @ORM\Column(name="descuento_especial", type="integer", length=255, nullable=true)
     */
    private $descuentoEspecial;

    /**
     *
     * @ORM\Column(name="pago_realizado", type="integer", nullable=true)
     */
    private $pagoRealizado;

    /**
     *
     * @ORM\Column(name="deuda", type="integer", nullable=true)
     */
    private $deuda;

    /**
     *
     * @ORM\Column(name="limpieza_realizada", type="integer", nullable=true)
     */
    private $limpiezaRealizada;

    /**
     *
     * @ORM\Column(name="co2_entregados", type="integer")
     */
    private $co2Entregados;

    /**
     *
     * @ORM\Column(name="co2_retirados", type="integer")
     */
    private $co2Retirados;

    /**
     *
     * @ORM\Column(name="co2_backup", type="integer")
     */
    private $co2Backup;

    /**
     *
     * @ORM\Column(name="barriles_entregados", type="integer")
     */
    private $barrilesEntregados;

    /**
     *
     * @ORM\Column(name="barriles_retirados", type="integer")
     */
    private $barrilesRetirados;

    /**
     *
     * @ORM\Column(name="barriles_cliente", type="integer")
     */
    private $barrilesCliente;

    /**
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;
    
    

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

    function getObservacion() {
        return $this->observacion;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    function getDeuda() {
        return $this->deuda;
    }

    function getCo2Entregados() {
        return $this->co2Entregados;
    }

    function getCo2Retirados() {
        return $this->co2Retirados;
    }

    function getCo2Backup() {
        return $this->co2Backup;
    }

    function getBarrilesRetirados() {
        return $this->barrilesRetirados;
    }

    function getBarrilesCliente() {
        return $this->barrilesCliente;
    }

    function setDeuda($deuda) {
        $this->deuda = $deuda;
    }

    function setCo2Entregados($co2Entregados) {
        $this->co2Entregados = $co2Entregados;
    }

    function setCo2Retirados($co2Retirados) {
        $this->co2Retirados = $co2Retirados;
    }

    function setCo2Backup($co2Backup) {
        $this->co2Backup = $co2Backup;
    }

    function setBarrilesRetirados($barrilesRetirados) {
        $this->barrilesRetirados = $barrilesRetirados;
    }

    function setBarrilesCliente($barrilesCliente) {
        $this->barrilesCliente = $barrilesCliente;
    }
    
    function getBarrilesEntregados() {
        return $this->barrilesEntregados;
    }

    function setBarrilesEntregados($barrilesEntregados) {
        $this->barrilesEntregados = $barrilesEntregados;
    }


}
