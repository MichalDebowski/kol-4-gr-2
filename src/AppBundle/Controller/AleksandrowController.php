<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Aleksandrow;
use AppBundle\Form\AleksandrowType;

/**
 * Aleksandrow controller.
 *
 * @Route("/admin/aleksandrow")
 */
class AleksandrowController extends Controller
{

    /**
     * Lists all Aleksandrow entities.
     *
     * @Route("/", name="admin_aleksandrow")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Aleksandrow')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Aleksandrow entity.
     *
     * @Route("/", name="admin_aleksandrow_create")
     * @Method("POST")
     * @Template("AppBundle:Aleksandrow:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Aleksandrow();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_aleksandrow_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Aleksandrow entity.
     *
     * @param Aleksandrow $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aleksandrow $entity)
    {
        $form = $this->createForm(new AleksandrowType(), $entity, array(
            'action' => $this->generateUrl('admin_aleksandrow_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aleksandrow entity.
     *
     * @Route("/new", name="admin_aleksandrow_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Aleksandrow();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Aleksandrow entity.
     *
     * @Route("/{id}", name="admin_aleksandrow_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Aleksandrow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aleksandrow entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Aleksandrow entity.
     *
     * @Route("/{id}/edit", name="admin_aleksandrow_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Aleksandrow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aleksandrow entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Aleksandrow entity.
    *
    * @param Aleksandrow $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aleksandrow $entity)
    {
        $form = $this->createForm(new AleksandrowType(), $entity, array(
            'action' => $this->generateUrl('admin_aleksandrow_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aleksandrow entity.
     *
     * @Route("/{id}", name="admin_aleksandrow_update")
     * @Method("PUT")
     * @Template("AppBundle:Aleksandrow:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Aleksandrow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aleksandrow entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_aleksandrow_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Aleksandrow entity.
     *
     * @Route("/{id}", name="admin_aleksandrow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Aleksandrow')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aleksandrow entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_aleksandrow'));
    }

    /**
     * Creates a form to delete a Aleksandrow entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_aleksandrow_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
