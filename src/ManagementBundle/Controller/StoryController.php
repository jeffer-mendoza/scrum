<?php

namespace ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Story;
use ManagementBundle\Form\StoryType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Story controller.
 *
 * @Route("/story")
 */
class StoryController extends Controller
{
    /**
     * get all user story
     *
     * @Route("/index", name="story_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stories = $em->getRepository('ManagementBundle:Story')->findAll();
        $serializer = $this->get('jms_serializer');
        $stories = $serializer->serialize($stories, 'json');
        return new Response($stories);
    }

    /**
     * Creates a new Story entity.
     *
     * @Route("/index", name="story_new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $story = new Story();
        try {
            $serializer = $this->get('jms_serializer');
            $story = $serializer->deserialize($request->getContent(), get_class($story), 'json');
            $em = $this->getDoctrine()->getManager();
            $em->merge($story);
            $em->flush();
            return new Response($story->getId());
        } catch (\Exception $ex) {
            var_dump($request->getContent());
            return new Response($ex->getMessage());
        }
    }

    /**
     * Creates a new Story entity.
     *
     * @Route("/edit", name="story_edit")
     * @Method("POST")
     */
    public function editAction(Request $request)
    {
        $story = new Story();
        try {
            $serializer = $this->get('jms_serializer');
            $story = $serializer->deserialize($request->getContent(), get_class($story), 'json');
            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();
            return new Response($story->getId());
        } catch (\Exception $ex) {
            var_dump($request->getContent());
            return new Response($ex->getMessage());
        }
    }


    /**
     * Deletes a Story entity.
     *
     * @Route("/{id}", name="story_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Story $story)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($story);
        $em->flush();

        return $this->redirectToRoute('story_index');
    }


    /**
     * @Route("/pdf/{id}", name="story_pdf")
     * @method({"GET"})
     * @param Story $story
     * @return Response
     */
    public function pdfAction(Story $story)
    {
        $html = $this->renderView(':story:pdf.html.twig', array(
            'story' => $story
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="file.pdf"'
            )
        );
    }
}
