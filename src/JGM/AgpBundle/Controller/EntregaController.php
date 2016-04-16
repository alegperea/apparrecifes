<?php

namespace JGM\AgpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JGM\AgpBundle\Entity\Entrega;
use JGM\AgpBundle\Form\EntregaType;
use JGM\CoreBundle\DBAL\Types\AuditoriaType;

/**
 * Entrega controller.
 *
 */
class EntregaController extends Controller {

    /**
     * Lists all Entrega entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AgpBundle:Entrega')->findAll();

        return $this->render('AgpBundle:Entrega:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Entrega entity.
     *
     */
    public function createAction(Request $request) {

        $entity = new Entrega();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
  

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Entrega creado correctamente');

            return $this->redirect($this->generateUrl('entrega_stepasigproductos', array('id' => $entity->getId())));
        }

        return $this->render('AgpBundle:Entrega:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

     /**
     * Displays a form to create a new Entrega entity.
     *
     */
    public function stepAsigProductosAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('AgpBundle:Producto')->findAll(); 
        $entity = $em->getRepository('AgpBundle:Entrega')->find($id);        
        if ($request->getMethod() == 'POST') {            
            $idproductos = $request->get('chk_productos');
            foreach($idproductos as $producto):
                $productoEntregaRef = new \JGM\AgpBundle\Entity\ProductoEntregaReference();
                $objproducto = $em->getRepository('AgpBundle:Producto')->find($producto);
                $productoEntregaRef->setProducto($objproducto);
                $productoEntregaRef->setEntrega($entity);
                $productoEntregaRef->setCantidad($entity->getCliente()->getCantidadPermitida());  
                $em->persist($productoEntregaRef);
                $em->flush();                    
            
            endforeach;            
            
            
            $this->setFlash('success', 'Asignacion de productos correctamente');
            return $this->redirect($this->generateUrl('entrega_stepconfirmfirma', array('id' => $entity->getId())));

        }
        
        return $this->render('AgpBundle:Entrega:_stepAsigProductos.html.twig', array(
                    'entity' => $entity,
                    'productos' => $productos
            
        ));
    }
    
    public function stepConfirmFirmaAction($id) {       
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('AgpBundle:Entrega')->find($id);
        
        return $this->render('AgpBundle:Entrega:_stepConfirmFirma.html.twig', array(
                    'entity' => $entity            
        ));
    }
    
    private function canvasUpload($data) {

                     
        if (file_get_contents("php://input")) {
            // read input stream   
            $data = file_get_contents("php://input");
            $this->canvasUpload($data);
        }
        // filtering and decoding code adapted from
        // http://stackoverflow.com/questions/11843115/uploading-canvas-context-as-image-using-ajax-and-php?lq=1
        // Filter out the headers (data:,) part.
        $filteredData = substr($data, strpos($data, ",") + 1);
        // Need to decode before saving since the data we received is already base64 encoded
        $decodedData = base64_decode($filteredData);

        // store in server
        $fic_name = 'snapshot' . rand(1000, 9999) . '.png';
        $fp = fopen('./firmas/' . $fic_name, 'wb');
        $ok = fwrite($fp, $decodedData);
        fclose($fp);
        if ($ok)
            echo $fic_name;
        else
            echo "ERROR";
    }

    /**
     * Función para crear Entrega por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new Entrega();
            $entity->setNombre($name);
            $em->persist($entity);
            $em->flush();
        }

        return $this->render("AgpsBundle:Default:_newOptionEntity.html.twig", array(
                    'entity' => $entity
        ));
    }

    /**
     * Creates a form to create a Entrega entity.
     *
     * @param Entrega $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Entrega $entity) {
        $form = $this->createForm(new EntregaType(), $entity, array(
            'action' => $this->generateUrl('entrega_create'),
            'method' => 'POST',
        ));

        return $form;
    }

   
    
    public function stepDatosCargaAction() {
        $entity = new Entrega();
        $form = $this->createCreateForm($entity);

        return $this->render('AgpBundle:Entrega:_stepDatosCarga.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Entrega entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AgpBundle:Entrega')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lugar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AgpBundle:Entrega:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Entrega entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AgpBundle:Entrega')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lugar entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('AgpBundle:Entrega:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Creates a form to edit a Lugar entity.
     *
     * @param Lugar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Entrega $entity) {
        $form = $this->createForm(new EntregaType(), $entity, array(
            'action' => $this->generateUrl('entrega_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Entrega entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AgpBundle:Entrega')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lugar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            /** @var $entity Entrega */
            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('entrega'));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AgpBundle:Entrega:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Entrega entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AgpBundle:Entrega')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lugar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('entrega'));
    }

    /**
     * Creates a form to delete a Entrega entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('entrega_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    private function setFlash($index, $message) {
        $this->get('session')->getFlashBag()->clear();
        $this->get('session')->getFlashBag()->add($index, $message);
    }

}
