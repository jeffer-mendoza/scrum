<?php

namespace ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Rol;
use ManagementBundle\Form\RolType;

/**
 * Rol controller.
 *
 * @Route("/rol")
 */
class RolController extends Controller
{
    /**
     * Lists all Rol entities.
     *
     * @Route("/", name="rol_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rols = $em->getRepository('ManagementBundle:Rol')->findAll();

        return $this->render('rol/index.html.twig', array(
            'rols' => $rols,
        ));
    }

    /**
     * Creates a new Rol entity.
     *
     * @Route("/new", name="rol_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rol = new Rol();
        $form = $this->createForm('ManagementBundle\Form\RolType', $rol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
            $em->flush();

            return $this->redirectToRoute('rol_index', array('id' => $rol->getId()));
        }

        return $this->render('rol/new.html.twig', array(
            'rol' => $rol,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Rol entity.
     *
     * @Route("/{id}/edit", name="rol_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rol $rol)
    {
        $deleteForm = $this->createDeleteForm($rol);
        $editForm = $this->createForm('ManagementBundle\Form\RolType', $rol);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
            $em->flush();

            return $this->redirectToRoute('rol_edit', array('id' => $rol->getId()));
        }

        return $this->render('rol/edit.html.twig', array(
            'rol' => $rol,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Rol entity.
     *
     * @Route("/{id}", name="rol_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rol $rol)
    {
        $form = $this->createDeleteForm($rol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rol);
            $em->flush();
        }

        return $this->redirectToRoute('rol_index');
    }

    /**
     * Creates a form to delete a Rol entity.
     *
     * @param Rol $rol The Rol entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rol $rol)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rol_delete', array('id' => $rol->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
