<?php

namespace JGM\AgpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * JGM\AgpBundle\Entity\Cliente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JGM\AgpBundle\Entity\ClienteRepository")
 */
class Cliente {

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
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(message="El nombre no puede estar en blanco")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=255)
     * @Assert\NotBlank(message="El contacto no puede estar en blanco")
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     * @Assert\NotBlank(message="la direccion no puede estar en blanco")
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     * @Assert\NotBlank(message="El tipo no puede estar en blanco")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="modalidad_pago", type="string", length=255)
     * @Assert\NotBlank(message="La modalidad de pago no puede estar en blanco")
     */
    private $modalidadPago;
    
    

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContacto() {
        return $this->contacto;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getModalidadPago() {
        return $this->modalidadPago;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setContacto($contacto) {
        $this->contacto = $contacto;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setModalidadPago($modalidadPago) {
        $this->modalidadPago = $modalidadPago;
    }

}
