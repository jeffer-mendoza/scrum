<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Entity\Project;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Sprint;
use ManagementBundle\Form\SprintType;

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
     * @Route("/{id}", name="sprint_index")
     * @Method("GET")
     */
    public function indexAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();

        $sprints = $em->getRepository('ManagementBundle:Sprint')->findBy(array('project' => $project->getId()), array('id' => 'ASC'));

        return $this->render('sprint/index.html.twig', array(
            'sprints' => $sprints,
            'project' => $project,
        ));
    }

    /**
     * Es llamado desde el menu izquierdo para setear los sprints en este panel
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sprintsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sprints = $em->getRepository('ManagementBundle:Sprint')->findAll();

        return $this->render('sprint/sprints.html.twig', array(
            'sprints' => $sprints,
        ));
    }

    /**
     * Creates a new Sprint entity.
     *
     * @Route("/new/{id}", name="sprint_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Project $project)
    {
        $sprint = new Sprint();
        $sprint->setProject($project);
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
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sprint entity.
     *
     * @Route("/show/{id}", name="sprint_show")
     * @Method("GET")
     */
    public function showAction(Sprint $sprint)
    {
        $deleteForm = $this->createDeleteForm($sprint);
        $array = $sprint->getBurndown();
        $string = json_encode($array, JSON_NUMERIC_CHECK);
        $string = str_replace('"', '', $string);

        return $this->render('sprint/show.html.twig', array(
            'sprint' => $sprint,
            'delete_form' => $deleteForm->createView(),
            'array' => $string
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
        $form = $this->createDeleteForm($sprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sprint);
            $em->flush();
        }

        return $this->redirectToRoute('story_index', array('id' => $sprint->getProject()->getId()));

    }

    /**
     * Creates a form to delete a Sprint entity.
     *
     * @param Sprint $sprint The Sprint entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sprint $sprint)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sprint_delete', array('id' => $sprint->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
