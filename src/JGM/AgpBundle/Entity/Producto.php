<?php

namespace JGM\AgpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * JGM\AgpBundle\Entity\Producto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JGM\AgpBundle\Entity\ProductoRepository")
 */
class Producto {

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
     * @ORM\Column(name="categoria", type="string", length=255)
     * @Assert\NotBlank(message="La categoria no puede estar en blanco")
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="integer")
     * @Assert\NotBlank(message="El precio no puede estar en blanco")
     */
    private $precio;

    /**
     * @ORM\OneToMany(targetEntity="JGM\AgpBundle\Entity\ProductoEntregaReference", mappedBy="producto", cascade={"persist", "remove"})
     */
    private $entrega;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function getEntrega() {
        return $this->entrega;
    }

    function setEntrega($entrega) {
        $this->entrega = $entrega;
    }

}
