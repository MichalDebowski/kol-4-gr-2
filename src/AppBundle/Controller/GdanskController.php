<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Gdansk;
use AppBundle\Form\GdanskType;

/**
 * Gdansk controller.
 *
 * @Route("/admin/gdansk")
 */
class GdanskController extends Controller
{

    /**
     * Lists all Gdansk entities.
     *
     * @Route("/", name="admin_gdansk")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Gdansk')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Gdansk entity.
     *
     * @Route("/", name="admin_gdansk_create")
     * @Method("POST")
     * @Template("AppBundle:Gdansk:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Gdansk();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gdansk_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Gdansk entity.
     *
     * @param Gdansk $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Gdansk $entity)
    {
        $form = $this->createForm(new GdanskType(), $entity, array(
            'action' => $this->generateUrl('admin_gdansk_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Gdansk entity.
     *
     * @Route("/new", name="admin_gdansk_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Gdansk();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Gdansk entity.
     *
     * @Route("/{id}", name="admin_gdansk_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Gdansk')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gdansk entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Gdansk entity.
     *
     * @Route("/{id}/edit", name="admin_gdansk_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Gdansk')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gdansk entity.');
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
    * Creates a form to edit a Gdansk entity.
    *
    * @param Gdansk $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Gdansk $entity)
    {
        $form = $this->createForm(new GdanskType(), $entity, array(
            'action' => $this->generateUrl('admin_gdansk_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Gdansk entity.
     *
     * @Route("/{id}", name="admin_gdansk_update")
     * @Method("PUT")
     * @Template("AppBundle:Gdansk:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Gdansk')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gdansk entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gdansk_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Gdansk entity.
     *
     * @Route("/{id}", name="admin_gdansk_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Gdansk')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gdansk entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_gdansk'));
    }

    /**
     * Creates a form to delete a Gdansk entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gdansk_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
