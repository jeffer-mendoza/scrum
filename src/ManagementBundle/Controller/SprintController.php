<?php

namespace ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Sprint;
use ManagementBundle\Form\SprintType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sprint controller.
 *
 * @Route("/sprint")
 */
class SprintController extends Controller
{
    /**
     * Lists all Sprint entities.
     *
     * @Route("/", name="sprint_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sprints = $em->getRepository('ManagementBundle:Sprint')->findAll();
        $serializer = $this->get('jms_serializer');
        $stories = $serializer->serialize($sprints, 'json');

        return new Response($sprints);
    }

    /**
     * Creates a new Sprint entity.
     *
     * @Route("/new", name="sprint_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sprint = new Sprint();
        $form = $this->createForm('ManagementBundle\Form\SprintType', $sprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sprint);
            $em->flush();

            return $this->redirectToRoute('sprint_show', array('id' => $sprint->getId()));
        }

        return $this->render('sprint/new.html.twig', array(
            'sprint' => $sprint,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Sprint entity.
     *
     * @Route("/{id}/edit", name="sprint_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sprint $sprint)
    {
        $deleteForm = $this->createDeleteForm($sprint);
        $editForm = $this->createForm('ManagementBundle\Form\SprintType', $sprint);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sprint);
            $em->flush();

            return $this->redirectToRoute('sprint_edit', array('id' => $sprint->getId()));
        }

        return $this->render('sprint/edit.html.twig', array(
            'sprint' => $sprint,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sprint entity.
     *
     * @Route("/{id}", name="sprint_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sprint $sprint)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($sprint);
        $em->flush();

        return $this->redirectToRoute('sprint_index');
    }
}
