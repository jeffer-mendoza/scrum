<?php

namespace ManagementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ManagementBundle\Entity\Project;
use ManagementBundle\Form\ProjectType;
use Symfony\Component\HttpFoundation\Response;
use ManagementBundle\Entity\Story;
use ManagementBundle\Entity\Sprint;
use ManagementBundle\Entity\Test;

/**
 * Project controller.
 *
 * @Route("/report")
 */
class ReportController extends Controller
{
    /**
     * Lists all Project entities.
     *
     * @Route("/", name="report_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('report/index.html.twig', array());
    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/story-list/pdf", name="report_story_list_pdf")
     * @Method("GET")
     * @return Response
     */
    public function storyListPdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stories = $em->getRepository('ManagementBundle:Story')->findAll();

        $html = $this->renderView('report/story-list.html.twig', array( 'stories' => $stories
        ));
        $nameFile = "GD-Stories-list.pdf";

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );


    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/story-generate/pdf", name="report_stories_generate_pdf")
     * @Method("GET")
     * @return Response
     */
    public function storiesGeneratePdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stories = $em->getRepository('ManagementBundle:Story')->findBy(array('project' => 1));

      foreach ($stories as $story) {
          $html = $this->renderView('report/pdf.html.twig', array(
              'story' => $story
          ));
          $nameFile = "SD" . $story->getNumber() . ".pdf";

          $this->get('knp_snappy.pdf')->generateFromHtml(
              $html,
              '/home/jeffer/SD/'.$nameFile
          );
      }

        return $this->redirectToRoute('story_index', array('id' => 1 ));

    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/test-generate/pdf", name="report_tests_generate_pdf")
     * @Method("GET")
     * @return Response
     */
    public function testsGeneratePdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tests = $em->getRepository('ManagementBundle:Test')->findAll();

        foreach ($tests as $test) {
            $html = $this->renderView('report/test-pdf.html.twig', array(
                'test' => $test
            ));
            $nameFile = "SDT" . $test->getNumber() . ".pdf";

            $this->get('knp_snappy.pdf')->generateFromHtml(
                $html,
                '/home/jeffer/SD/test/'.$nameFile
            );
        }

        return $this->redirectToRoute('story_index', array('id' => 1 ));

    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/product-backlog/pdf", name="report_product_backlog_pdf")
     * @Method("GET")
     * @return Response
     */
    public function productBacklogPdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stories = $em->getRepository('ManagementBundle:Story')->findAll();

        $html = $this->renderView('report/product-backlog.html.twig', array( 'stories' => $stories
        ));
        $nameFile = "GD-product-backlog.pdf";

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );

    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/product-backlog/image", name="report_product_backlog_image")
     * @Method("GET")
     * @return Response
     */
    public function productBacklogImageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stories = $em->getRepository('ManagementBundle:Story')->findBy(array(), array('id' => 'ASC'));

        $html = $this->renderView('report/product-backlog-image.html.twig', array( 'stories' => $stories
        ));
        $nameFile = "GD-product-backlog.jpg";

        return new Response(
            $this->get('knp_snappy.image')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'image/jpg',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );

    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/story/{id}/pdf", name="report_story_pdf")
     * @Method("GET")
     * @return Response
     */
    public function storyPdfAction(Story $story)
    {

        $html = $this->renderView('report/pdf.html.twig', array(
            'story' => $story
        ));
        $nameFile = "SD" . $story->getNumber() . ".pdf";

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );

        return $this->render('report/pdf.html.twig', array('story' => $story));

    }


    /**
     * Generate user story in pdf format
     *
     * @Route("/story/{id}/image", name="report_story_image")
     * @Method("GET")
     * @return Response
     */
    public
    function storyImageAction(Story $story)
    {

        $html = $this->renderView('report/image.html.twig', array(
            'story' => $story
        ));
        $nameFile = "GD" . $story->getNumber() . ".jpg";

        return new Response(
            $this->get('knp_snappy.image')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'image/jpg',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );


    }


    /**
     * Generate user story in pdf format
     *
     * @Route("/sprint-backlog/{id}/pdf", name="report_sprint_backlog_pdf")
     * @Method("GET")
     * @return Response
     */
    public function sprintBacklogPdfAction(Sprint $sprint)
    {
        $em = $this->getDoctrine()->getManager();
        $stories = $em->getRepository('ManagementBundle:Story')->findBy(array('sprint' => $sprint->getId()), array('points' => 'DESC'));

        $html = $this->renderView('report/sprint-backlog.html.twig', array('sprint' => $sprint, 'stories' => $stories
        ));
        $nameFile = "sedoc-iteracion-".$sprint->getNumber().".pdf";

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );

    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/sprint-backlog/{id}/image", name="report_sprint_backlog_image")
     * @Method("GET")
     * @return Response
     */
    public function sprintBacklogImageAction(Sprint $sprint)
    {
        $em = $this->getDoctrine()->getManager();
        $stories = $em->getRepository('ManagementBundle:Story')->findBy(array('sprint' => $sprint->getId()), array('points' => 'DESC'));


        $html = $this->renderView('report/sprint-backlog-image.html.twig', array('sprint' => $sprint, 'stories' => $stories
        ));
        $nameFile = "sedoc-iteracion-".$sprint->getNumber().".jpg";

        return new Response(
            $this->get('knp_snappy.image')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'image/jpg',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );

    }

    /**
     * Generate user story in pdf format
     *
     * @Route("/test/{id}/pdf", name="report_test_pdf")
     * @Method("GET")
     * @return Response
     */
    public function testPdfAction(Test $test)
    {

        $html = $this->renderView('report/test-pdf.html.twig', array(
            'test' => $test
        ));
        $nameFile = "SDT" . $test->getId() . ".pdf";

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );

    }



}
