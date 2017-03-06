<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Form\CreateStoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Story;
use ManagementBundle\Form\StoryType;
use ManagementBundle\Entity\Project;

/**
 * Story controller.
 *
 * @Route("/story")
 */
class StoryController extends Controller
{
    /**
     * Lists all Story entities.
     *
     * @Route("/{id}", name="story_index")
     * @Method("GET")
     */
    public function indexAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();

        $stories = $em->getRepository('ManagementBundle:Story')->findBy(array('project' => $project->getId() ),array('id'=>'ASC'));

        return $this->render('story/index.html.twig', array(
            'stories' => $stories,
            'project' => $project,
        ));
    }

    /**
     * Creates a new Story entity.
     *
     * @Route("/new/{id}", name="story_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Project $project)
    {
        $story = new Story();
        $story->setProject($project);
        $storyType = new CreateStoryType(array('project' => $project));
        $form = $this->createForm($storyType, $story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();

            return $this->redirectToRoute('story_show', array('id' => $story->getId()));
        }

        return $this->render('story/new.html.twig', array(
            'story' => $story,
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Story entity.
     *
     * @Route("/show/{id}", name="story_show")
     * @Method("GET")
     */
    public function showAction(Story $story)
    {
        $deleteForm = $this->createDeleteForm($story);

        return $this->render('story/show.html.twig', array(
            'story' => $story,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Story entity.
     *
     * @Route("/{id}/edit", name="story_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Story $story)
    {
        $deleteForm = $this->createDeleteForm($story);
        $editForm = $this->createForm('ManagementBundle\Form\StoryType', $story);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();

            return $this->redirectToRoute('story_show', array('id' => $story->getId()));
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
     * @Route("/{id}", name="story_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Story $story)
    {
        $form = $this->createDeleteForm($story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($story);
            $em->flush();
        }

        return $this->redirectToRoute('story_index');
    }

    /**
     * Creates a form to delete a Story entity.
     *
     * @param Story $story The Story entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Story $story)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('story_delete', array('id' => $story->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
