<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Entity\Comment;
use ManagementBundle\Entity\SpendEffort;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\AcceptanceRequirement;
use ManagementBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Response;

/**
 * AcceptanceRequirement controller.
 *
 * @Route("/story-information")
 */
class StoryInformationController extends Controller
{

    /**
     * Creates a new AcceptanceRequirement entity.
     *
     * @Route("/acceptance-requirement", name="acceptancerequirement_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $description = $data['description'];
        $id = $data['story'];
        $em = $this->getDoctrine()->getManager();
        $story = $em->getRepository('ManagementBundle:Story')->find($id);
        $acceptanceRequirement = new AcceptanceRequirement();
        $acceptanceRequirement->setDescription($description);
        $acceptanceRequirement->setStory($story);
        $story->addAcceptanceRequirement($acceptanceRequirement);
        $em->persist($story);
        $em->flush();

        return new Response($acceptanceRequirement->getId(), 200);
    }

    /**
     * Creates a new task entity.
     *
     * @Route("/task", name="task_new")
     * @Method({"POST"})
     */
    public function newTaskAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $description = $data['description'];
        $id = $data['story'];
        $em = $this->getDoctrine()->getManager();
        $story = $em->getRepository('ManagementBundle:Story')->find($id);
        $task = new Task();
        $task->setDescription($description);
        $task->setStory($story);
        $story->addTask($task);
        $em->persist($story);
        $em->flush();

        return new Response($task->getId(), 200);
    }

    /**
     * Creates a new task entity.
     *
     * @Route("/spend-effort", name="spend_effort_new")
     * @Method({"POST"})
     */
    public function newSpendEffortAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $date = \DateTime::createFromFormat('Y-m-d\TH:i', $data['date']);
        $effort = $data['effort'];
        $id = $data['story'];
        $em = $this->getDoctrine()->getManager();
        $story = $em->getRepository('ManagementBundle:Story')->find($id);
        $spendEffort = new SpendEffort();
        $spendEffort->setEffort($effort);
        $spendEffort->setDate($date);
        $spendEffort->setStory($story);
        $story->addSpendEffort($spendEffort);
        $em->persist($story);
        $em->flush();

        return new Response($spendEffort->getId(), 200);
    }

    /**
     * Creates a new comment entity.
     *
     * @Route("/comment", name="comment_new")
     * @Method({"POST"})
     */
    public function newCommentAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $detail = $data['detail'];
        $id = $data['story'];
        $em = $this->getDoctrine()->getManager();
        $story = $em->getRepository('ManagementBundle:Story')->find($id);
        $comment = new Comment();
        $comment->setDetail($detail);
        $comment->setStory($story);
        $story->addComment($comment);
        $em->persist($story);
        $em->flush();

        return new Response($comment->getId(), 200);
    }

    /**
     * Deletes a AcceptanceRequirement entity.
     *
     * @Route("/delete/acceptance/{id}", name="acceptance_requirement_delete")
     * @Method("GET")
     */
    public
    function deleteAction(Request $request, AcceptanceRequirement $acceptanceRequirement)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($acceptanceRequirement);
        $em->flush();

        return $this->redirect($this->generateUrl('story_show',array('id' => $acceptanceRequirement->getStory()->getId())));

    }

    /**
     * Deletes a Comment entity.
     *
     * @Route("/delete/comment/{id}", name="comment_delete")
     * @Method("GET")
     */
    public
    function deleteCommentAction(Request $request, Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('story_show',array('id' => $comment->getStory()->getId())));

    }

    /**
     * Deletes a task entity.
     *
     * @Route("/delete/task/{id}", name="task_delete")
     * @Method("GET")
     */
    public
    function deleteTaskAction(Request $request, Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirect($this->generateUrl('story_show',array('id' => $task->getStory()->getId())));
    }

    /**
     * Deletes a task entity.
     *
     * @Route("/delete/effort/{id}", name="spend_effort_delete")
     * @Method("GET")
     */
    public
    function deleteSpendEffortAction(Request $request, SpendEffort $spendEffort)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($spendEffort);
        $em->flush();

        return $this->redirect($this->generateUrl('story_show',array('id' => $spendEffort->getStory()->getId())));
    }

}
