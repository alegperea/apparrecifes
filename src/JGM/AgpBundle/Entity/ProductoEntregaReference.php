<?php

namespace JGM\AgpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * JGM\AgpBundle\Entity\ProductoEntregaReference
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JGM\AgpBundle\Entity\ProductoEntregaReferenceRepository")
 */
class ProductoEntregaReference 
{
   
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
   
    /**
    * @ORM\ManyToOne(targetEntity="JGM\AgpBundle\Entity\Producto", inversedBy="productos")
    */
    protected $producto;

    /**
    * @ORM\ManyToOne(targetEntity="JGM\AgpBundle\Entity\Entrega", inversedBy="entrega")
    */
    protected $entrega;
    
    /**
   * @var string
   *
   * @ORM\Column(name="cantidad", type="integer")
   * @Assert\NotBlank(message="La cantidado no puede estar en blanco")
   */
   private $cantidad;
    
   
   function getId() {
       return $this->id;
   }

   function getProducto() {
       return $this->producto;
   }

   function getEntrega() {
       return $this->entrega;
   }

   function getCantidad() {
       return $this->cantidad;
   }

   function setProducto($producto) {
       $this->producto = $producto;
   }

   function setEntrega($entrega) {
       $this->entrega = $entrega;
   }

   function setCantidad($cantidad) {
       $this->cantidad = $cantidad;
   }


}

