<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Entity\Story;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ManagementBundle\Entity\Project;

/**
 * Story controller.
 *
 * @Route("/board")
 */
class DefaultController extends Controller
{
    /**
     * Lists all meet entities.
     *
     * @Route("/{id}", name="management_homepage")
     * @Method("GET")
     */
    public function indexAction(Project $project)
    {

        $em = $this->getDoctrine()->getManager();

        $stories_todo = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::TODO,'project' => $project->getId()));
        $stories_inprogress = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::INPROGRESS,'project' => $project->getId()));
        $stories_done = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::DONE,'project' => $project->getId()));
        $stories_accept = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::ACCEPT,'project' => $project->getId()));

        return $this->render('ManagementBundle:Default:index.html.twig', array(
            'stories_todo' => $stories_todo,
            'stories_inprogress' => $stories_inprogress,
            'stories_done' => $stories_done,
            'stories_accept' => $stories_accept,
        ));
    }
}
