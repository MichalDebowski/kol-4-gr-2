<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Dublin;
use AppBundle\Form\DublinType;

/**
 * Dublin controller.
 *
 * @Route("/admin/dublin")
 */
class DublinController extends Controller
{

    /**
     * Lists all Dublin entities.
     *
     * @Route("/", name="admin_dublin")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Dublin')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Dublin entity.
     *
     * @Route("/", name="admin_dublin_create")
     * @Method("POST")
     * @Template("AppBundle:Dublin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Dublin();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_dublin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Dublin entity.
     *
     * @param Dublin $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Dublin $entity)
    {
        $form = $this->createForm(new DublinType(), $entity, array(
            'action' => $this->generateUrl('admin_dublin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Dublin entity.
     *
     * @Route("/new", name="admin_dublin_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Dublin();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Dublin entity.
     *
     * @Route("/{id}", name="admin_dublin_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Dublin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dublin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Dublin entity.
     *
     * @Route("/{id}/edit", name="admin_dublin_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Dublin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dublin entity.');
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
    * Creates a form to edit a Dublin entity.
    *
    * @param Dublin $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Dublin $entity)
    {
        $form = $this->createForm(new DublinType(), $entity, array(
            'action' => $this->generateUrl('admin_dublin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Dublin entity.
     *
     * @Route("/{id}", name="admin_dublin_update")
     * @Method("PUT")
     * @Template("AppBundle:Dublin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Dublin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dublin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_dublin_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Dublin entity.
     *
     * @Route("/{id}", name="admin_dublin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Dublin')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dublin entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_dublin'));
    }

    /**
     * Creates a form to delete a Dublin entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_dublin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
