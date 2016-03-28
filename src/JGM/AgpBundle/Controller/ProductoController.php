<?php

namespace JGM\AgpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JGM\AgpBundle\Entity\Producto;
use JGM\AgpBundle\Form\ProductoType;
use JGM\CoreBundle\DBAL\Types\AuditoriaType;

/**
 * Producto controller.
 *
 */
class ProductoController extends Controller {

  /**
   * Lists all Productos entities.
   *
   */
    public function indexAction() {

      $em = $this->getDoctrine()->getManager();
      $entities = $em->getRepository('AgpBundle:Producto')->findAll();         
      
      return $this->render('AgpBundle:Producto:index.html.twig', array(
		  'entities' => $entities,
      ));
    }

    /**
     * Creates a new Producto entity.
     *
     */
    public function createAction(Request $request) {
      $entity = new Producto();
      $form = $this->createCreateForm($entity);
      $form->handleRequest($request);

      if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$em->persist($entity);
	$em->flush();

	$this->setFlash('success', 'Producto creado correctamente');

	return $this->redirect($this->generateUrl('producto'));
      }

      return $this->render('AgpBundle:Producto:new.html.twig', array(
		  'entity' => $entity,
		  'form' => $form->createView(),
      ));
    }

    /**
     * Función para crear Productos por Ajax
     */
    public function createAjaxAction(Request $request) {
      if ($request->getMethod() == "POST") {
	$em = $this->getDoctrine()->getManager();
	$name = $request->get('name');
	$entity = new Producto();
	$entity->setNombre($name);
	$em->persist($entity);
	$em->flush();
      }

      return $this->render("AgpsBundle:Default:_newOptionEntity.html.twig", array(
	  'entity' => $entity
      ));
    }

    /**
     * Creates a form to create a Producto entity.
     *
     * @param Producto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Producto $entity) {
      $form = $this->createForm(new ProductoType(), $entity, array(
	  'action' => $this->generateUrl('producto_create'),
	  'method' => 'POST',
      ));

      return $form;
    }

    /**
     * Displays a form to create a new Producto entity.
     *
     */
    public function newAction() {
      $entity = new Producto();
      $form = $this->createCreateForm($entity);

      return $this->render('AgpBundle:Producto:new.html.twig', array(
		  'entity' => $entity,
		  'form' => $form->createView(),
      ));
    }

    /**
     * Finds and displays a Producto entity.
     *
     */
    public function showAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AgpBundle:Producto')->find($id);

      if (!$entity) {
	throw $this->createNotFoundException('Unable to find Producto entity.');
      }

      $deleteForm = $this->createDeleteForm($id);

      return $this->render('AgpBundle:Producto:show.html.twig', array(
		  'entity' => $entity,
		  'delete_form' => $deleteForm->createView(),
      ));
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     */
    public function editAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AgpBundle:Producto')->find($id);

      if (!$entity) {
	throw $this->createNotFoundException('Unable to find Producto entity.');
      }

      $editForm = $this->createEditForm($entity);

      return $this->render('CarrerasBundle:Producto:edit.html.twig', array(
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
    private function createEditForm(Producto $entity) {
      $form = $this->createForm(new ProductoType(), $entity, array(
	  'action' => $this->generateUrl('producto_update', array('id' => $entity->getId())),
	  'method' => 'PUT',
      ));

      return $form;
    }

    /**
     * Edits an existing Producto entity.
     *
     */
    public function updateAction(Request $request, $id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AgpBundle:Producto')->find($id);

      if (!$entity) {
	throw $this->createNotFoundException('Unable to find Lugar entity.');
      }

      $deleteForm = $this->createDeleteForm($id);
      $editForm = $this->createEditForm($entity);
      $editForm->submit($request);

      if ($editForm->isValid()) {
	/** @var $entity Producto */	
	$em->persist($entity);
	$em->flush();

	$this->setFlash('success', 'Los cambios se han realizado con éxito');
	return $this->redirect($this->generateUrl('producto'));
      }

      $this->setFlash('error', 'Ha ocurrido un error');
      return $this->render('AgpBundle:Producto:edit.html.twig', array(
		  'entity' => $entity,
		  'form' => $editForm->createView(),
		  'delete_form' => $deleteForm->createView(),
      ));
    }

    /**
     * Deletes a Producto entity.
     *
     */
    public function deleteAction(Request $request, $id) {
      $form = $this->createDeleteForm($id);
      $form->handleRequest($request);

      if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$entity = $em->getRepository('AgpBundle:Producto')->find($id);

	if (!$entity) {
	  throw $this->createNotFoundException('Unable to find Producto entity.');
	}

	$em->remove($entity);
	$em->flush();
      }

      return $this->redirect($this->generateUrl('producto'));
    }

    /**
     * Creates a form to delete a Producto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
      return $this->createFormBuilder()
		      ->setAction($this->generateUrl('producto_delete', array('id' => $id)))
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
