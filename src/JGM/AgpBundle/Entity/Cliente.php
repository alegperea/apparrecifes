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
class Cliente 
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
    * @Assert\NotBlank(message="El nombre no puede estar en blanco")
    */
   private $contacto;
   
   /**
   * @var string
   *
   * @ORM\Column(name="direccion", type="string", length=255)
   * @Assert\NotBlank(message="El nombre no puede estar en blanco")
   */
   private $direccion;

   
    /**
    * @var string
    *
    * @ORM\Column(name="tipo", type="string", length=255)
    * @Assert\NotBlank(message="El nombre no puede estar en blanco")
    */
   private $tipo;
   
    /**
    * @var string
    *
    * @ORM\Column(name="modalidad_pago", type="string", length=255)
    * @Assert\NotBlank(message="El nombre no puede estar en blanco")
    */
   private $modalidadPago;

   
   
   function getId() {
       return $this->id;
   }

   function getNombre() {
       return $this->nombre;
   }

   function getContacto() {
       return $this->contacto;
   }

   function getDireccion() {
       return $this->direccion;
   }

   function getTipo() {
       return $this->tipo;
   }

   function getModalidadPago() {
       return $this->modalidadPago;
   }

   function setNombre($nombre) {
       $this->nombre = $nombre;
   }

   function setContacto($contacto) {
       $this->contacto = $contacto;
   }

   function setDireccion($direccion) {
       $this->direccion = $direccion;
   }

   function setTipo($tipo) {
       $this->tipo = $tipo;
   }

   function setModalidadPago($modalidadPago) {
       $this->modalidadPago = $modalidadPago;
   }


    

    
}

