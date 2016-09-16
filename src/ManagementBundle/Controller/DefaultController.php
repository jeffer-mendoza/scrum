<?php

namespace ManagementBundle\Controller;

use ManagementBundle\Entity\Story;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $stories_todo = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::TODO));
        $stories_inprogress = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::INPROGRESS));
        $stories_done = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::DONE));
        $stories_accept = $em->getRepository('ManagementBundle:Story')->findBy(array('status' => Story::ACCEPT));

        return $this->render('ManagementBundle:Default:index.html.twig', array(
            'stories_todo' => $stories_todo,
            'stories_inprogress' => $stories_inprogress,
            'stories_done' => $stories_done,
            'stories_accept' => $stories_accept,
        ));
    }
}
