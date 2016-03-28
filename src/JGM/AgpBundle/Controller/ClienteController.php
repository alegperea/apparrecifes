<?php

namespace JGM\AgpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JGM\AgpBundle\Entity\Cliente;
use JGM\AgpBundle\Form\ClienteType;
use JGM\CoreBundle\DBAL\Types\AuditoriaType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller {

  /**
   * Lists all Cliente entities.
   *
   */
    public function indexAction() {

      $em = $this->getDoctrine()->getManager();
      $entities = $em->getRepository('AgpBundle:Cliente')->findAll();         
      
      return $this->render('AgpBundle:Cliente:index.html.twig', array(
		  'entities' => $entities,
      ));
    }

    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction(Request $request) {
      $entity = new Cliente();
      $form = $this->createCreateForm($entity);
      $form->handleRequest($request);

      if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$em->persist($entity);
	$em->flush();

	$this->setFlash('success', 'Cliente creado correctamente');

	return $this->redirect($this->generateUrl('cliente'));
      }

      return $this->render('AgpBundle:Cliente:new.html.twig', array(
		  'entity' => $entity,
		  'form' => $form->createView(),
      ));
    }

    /**
     * Función para crear Clientes por Ajax
     */
    public function createAjaxAction(Request $request) {
      if ($request->getMethod() == "POST") {
	$em = $this->getDoctrine()->getManager();
	$name = $request->get('name');
	$entity = new Cliente();
	$entity->setNombre($name);
	$em->persist($entity);
	$em->flush();
      }

      return $this->render("AgpsBundle:Default:_newOptionEntity.html.twig", array(
	  'entity' => $entity
      ));
    }

    /**
     * Creates a form to create a Cliente entity.
     *
     * @param Cliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cliente $entity) {
      $form = $this->createForm(new ClienteType(), $entity, array(
	  'action' => $this->generateUrl('cliente_create'),
	  'method' => 'POST',
      ));

      return $form;
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction() {
      $entity = new Cliente();
      $form = $this->createCreateForm($entity);

      return $this->render('AgpBundle:Cliente:new.html.twig', array(
		  'entity' => $entity,
		  'form' => $form->createView(),
      ));
    }

    /**
     * Finds and displays a Cliente entity.
     *
     */
    public function showAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AgpBundle:Cliente')->find($id);

      if (!$entity) {
	throw $this->createNotFoundException('Unable to find Lugar entity.');
      }

      $deleteForm = $this->createDeleteForm($id);

      return $this->render('AgpBundle:Cliente:show.html.twig', array(
		  'entity' => $entity,
		  'delete_form' => $deleteForm->createView(),
      ));
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AgpBundle:Cliente')->find($id);

      if (!$entity) {
	throw $this->createNotFoundException('Unable to find Lugar entity.');
      }

      $editForm = $this->createEditForm($entity);

      return $this->render('AgpBundle:Cliente:edit.html.twig', array(
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
    private function createEditForm(Cliente $entity) {
      $form = $this->createForm(new ClienteType(), $entity, array(
	  'action' => $this->generateUrl('cliente_update', array('id' => $entity->getId())),
	  'method' => 'PUT',
      ));

      return $form;
    }

    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction(Request $request, $id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AgpBundle:Cliente')->find($id);

      if (!$entity) {
	throw $this->createNotFoundException('Unable to find Lugar entity.');
      }

      $deleteForm = $this->createDeleteForm($id);
      $editForm = $this->createEditForm($entity);
      $editForm->submit($request);

      if ($editForm->isValid()) {
	/** @var $entity Cliente */	
	$em->persist($entity);
	$em->flush();

	$this->setFlash('success', 'Los cambios se han realizado con éxito');
	return $this->redirect($this->generateUrl('cliente'));
      }

      $this->setFlash('error', 'Ha ocurrido un error');
      return $this->render('AgpBundle:Cliente:edit.html.twig', array(
		  'entity' => $entity,
		  'form' => $editForm->createView(),
		  'delete_form' => $deleteForm->createView(),
      ));
    }

    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction(Request $request, $id) {
      $form = $this->createDeleteForm($id);
      $form->handleRequest($request);

      if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$entity = $em->getRepository('AgpBundle:Cliente')->find($id);

	if (!$entity) {
	  throw $this->createNotFoundException('Unable to find Lugar entity.');
	}

	$em->remove($entity);
	$em->flush();
      }

      return $this->redirect($this->generateUrl('cliente'));
    }

    /**
     * Creates a form to delete a Cliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
      return $this->createFormBuilder()
		      ->setAction($this->generateUrl('cliente_delete', array('id' => $id)))
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
