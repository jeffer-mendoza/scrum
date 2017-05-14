<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Form\CreateStoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Story;
use ManagementBundle\Entity\AcceptanceRequirement;
use ManagementBundle\Form\StoryType;
use ManagementBundle\Entity\Project;

/**
 * Story controller.
 *
 * @Route("/requeriment")
 */
class RequerimentController extends Controller
{

    /**
     * Finds and displays a Story entity.
     *
     * @Route("/show/{id}", name="requeriment_show")
     * @Method("GET")
     */
    public function showAction(AcceptanceRequirement $requeriment)
    {

        return $this->render('requeriment/show.html.twig', array(
            'requeriment' => $requeriment,
        ));
    }

    /**
     * Displays a form to edit an existing Story entity.
     *
     * @Route("/{id}/edit", name="requeriment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AcceptanceRequirement $requirement)
    {
        $deleteForm = $this->createDeleteForm(requeriment);
        $editForm = $this->createForm('ManagementBundle\Form\RequirementType', $requirement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirement);
            $em->flush();

            return $this->redirectToRoute('story_show', array('id' => $requirement->getStory()->getId()));
        }

        return $this->render('story/edit.html.twig', array(
            'story' => $story,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Story entity.
     *
     * @Route("/{id}", name="requirement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AcceptanceRequirement $requirement)
    {
        $form = $this->createDeleteForm($requirement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($requirement);
            $em->flush();
        }

        return $this->redirectToRoute('story_show',array('id' => $requirement->getStory()->getId()));
    }

    /**
     * Creates a form to delete a Story entity.
     *
     * @param Story $story The Story entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AcceptanceRequirement $requirement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requeriment_delete', array('id' => $requirement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
