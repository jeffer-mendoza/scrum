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
     * @Route("/story/{id}/pdf", name="report_story_pdf")
     * @Method("GET")
     * @return Response
     */
    public function storyPdfAction(Story $story)
    {

        $html = $this->renderView('report/pdf.html.twig', array(
            'story' => $story
        ));
        $nameFile = "GD" . $story->getId() . ".pdf";

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
        $nameFile = "GD" . $story->getId() . ".jpg";

        return new Response(
            $this->get('knp_snappy.image')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'image/jpg',
                'Content-Disposition' => 'attachment; filename="' . $nameFile . '"'
            )
        );


    }

}
