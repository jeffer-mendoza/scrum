<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Entity\Meet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Meet controller.
 *
 * @Route("meet")
 */
class MeetController extends Controller
{
    /**
     * Lists all meet entities.
     *
     * @Route("/", name="meet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $meets = $em->getRepository('ManagementBundle:Meet')->findAll();

        return $this->render('meet/index.html.twig', array(
            'meets' => $meets,
        ));
    }

    /**
     * Creates a new meet entity.
     *
     * @Route("/new", name="meet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $meet = new Meet();
        $form = $this->createForm('ManagementBundle\Form\MeetType', $meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meet);
            $em->flush($meet);

            return $this->redirectToRoute('meet_show', array('id' => $meet->getId()));
        }

        return $this->render('meet/new.html.twig', array(
            'meet' => $meet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a meet entity.
     *
     * @Route("/{id}", name="meet_show")
     * @Method("GET")
     */
    public function showAction(Meet $meet)
    {
        $deleteForm = $this->createDeleteForm($meet);

        return $this->render('meet/show.html.twig', array(
            'meet' => $meet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing meet entity.
     *
     * @Route("/{id}/edit", name="meet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Meet $meet)
    {
        $deleteForm = $this->createDeleteForm($meet);
        $editForm = $this->createForm('ManagementBundle\Form\MeetType', $meet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meet_edit', array('id' => $meet->getId()));
        }

        return $this->render('meet/edit.html.twig', array(
            'meet' => $meet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a meet entity.
     *
     * @Route("/{id}", name="meet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Meet $meet)
    {
        $form = $this->createDeleteForm($meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meet);
            $em->flush($meet);
        }

        return $this->redirectToRoute('meet_index');
    }

    /**
     * Creates a form to delete a meet entity.
     *
     * @param Meet $meet The meet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Meet $meet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meet_delete', array('id' => $meet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
