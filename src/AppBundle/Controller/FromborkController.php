<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Frombork;
use AppBundle\Form\FromborkType;

/**
 * Frombork controller.
 *
 * @Route("/admin/frombork")
 */
class FromborkController extends Controller
{

    /**
     * Lists all Frombork entities.
     *
     * @Route("/", name="admin_frombork")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Frombork')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Frombork entity.
     *
     * @Route("/", name="admin_frombork_create")
     * @Method("POST")
     * @Template("AppBundle:Frombork:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Frombork();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_frombork_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Frombork entity.
     *
     * @param Frombork $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Frombork $entity)
    {
        $form = $this->createForm(new FromborkType(), $entity, array(
            'action' => $this->generateUrl('admin_frombork_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Frombork entity.
     *
     * @Route("/new", name="admin_frombork_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Frombork();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Frombork entity.
     *
     * @Route("/{id}", name="admin_frombork_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Frombork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Frombork entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Frombork entity.
     *
     * @Route("/{id}/edit", name="admin_frombork_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Frombork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Frombork entity.');
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
    * Creates a form to edit a Frombork entity.
    *
    * @param Frombork $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Frombork $entity)
    {
        $form = $this->createForm(new FromborkType(), $entity, array(
            'action' => $this->generateUrl('admin_frombork_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Frombork entity.
     *
     * @Route("/{id}", name="admin_frombork_update")
     * @Method("PUT")
     * @Template("AppBundle:Frombork:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Frombork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Frombork entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_frombork_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Frombork entity.
     *
     * @Route("/{id}", name="admin_frombork_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Frombork')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Frombork entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_frombork'));
    }

    /**
     * Creates a form to delete a Frombork entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_frombork_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
