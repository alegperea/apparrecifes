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

	return $this->redirect($this->generateUrl('entrega'));
      }

      return $this->render('AgpBundle:Entrega:new.html.twig', array(
		  'entity' => $entity,
		  'form' => $form->createView(),
      ));
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

    /**
     * Displays a form to create a new Entrega entity.
     *
     */
    public function newAction() {
      $entity = new Entrega();
      $form = $this->createCreateForm($entity);

      return $this->render('AgpBundle:Entrega:new.html.twig', array(
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
