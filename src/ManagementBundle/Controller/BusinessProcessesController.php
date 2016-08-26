<?php

namespace ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\BusinessProcesses;
use ManagementBundle\Form\BusinessProcessesType;

/**
 * BusinessProcesses controller.
 *
 * @Route("/businessprocesses")
 */
class BusinessProcessesController extends Controller
{
    /**
     * Lists all BusinessProcesses entities.
     *
     * @Route("/", name="businessprocesses_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $businessProcesses = $em->getRepository('ManagementBundle:BusinessProcesses')->findAll();

        return $this->render('businessprocesses/index.html.twig', array(
            'businessProcesses' => $businessProcesses,
        ));
    }

    /**
     * Creates a new BusinessProcesses entity.
     *
     * @Route("/new", name="businessprocesses_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $businessProcess = new BusinessProcesses();
        $form = $this->createForm('ManagementBundle\Form\BusinessProcessesType', $businessProcess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($businessProcess);
            $em->flush();

            return $this->redirectToRoute('businessprocesses_show', array('id' => $businessProcess->getId()));
        }

        return $this->render('businessprocesses/new.html.twig', array(
            'businessProcess' => $businessProcess,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BusinessProcesses entity.
     *
     * @Route("/{id}", name="businessprocesses_show")
     * @Method("GET")
     */
    public function showAction(BusinessProcesses $businessProcess)
    {
        $deleteForm = $this->createDeleteForm($businessProcess);

        return $this->render('businessprocesses/show.html.twig', array(
            'businessProcess' => $businessProcess,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BusinessProcesses entity.
     *
     * @Route("/{id}/edit", name="businessprocesses_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BusinessProcesses $businessProcess)
    {
        $deleteForm = $this->createDeleteForm($businessProcess);
        $editForm = $this->createForm('ManagementBundle\Form\BusinessProcessesType', $businessProcess);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($businessProcess);
            $em->flush();

            return $this->redirectToRoute('businessprocesses_edit', array('id' => $businessProcess->getId()));
        }

        return $this->render('businessprocesses/edit.html.twig', array(
            'businessProcess' => $businessProcess,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BusinessProcesses entity.
     *
     * @Route("/{id}", name="businessprocesses_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BusinessProcesses $businessProcess)
    {
        $form = $this->createDeleteForm($businessProcess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($businessProcess);
            $em->flush();
        }

        return $this->redirectToRoute('businessprocesses_index');
    }

    /**
     * Creates a form to delete a BusinessProcesses entity.
     *
     * @param BusinessProcesses $businessProcess The BusinessProcesses entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BusinessProcesses $businessProcess)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('businessprocesses_delete', array('id' => $businessProcess->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
