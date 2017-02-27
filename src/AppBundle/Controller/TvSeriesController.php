<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TvSeries;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TvSeriesController extends Controller
{
    /**
     * @Route("/", name="tvseries")
     */
    public function listAction(Request $request)
    {
        // replace this example code with whatever you need
        $ss = $this->getDoctrine()->getManager()->getRepository(TvSeries::class)->findAll();
        return $this->render("homepage/index.html.twig",['series' => $ss]);
    }

    /**
     * @Route("/series/create")
     * @param Request $request
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function createSeries(Request $request)
    {
        $serie = new TvSeries();
        $form = $this->createForm('AppBundle\Form\TvSeriesType',$serie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serie);
            $em->flush($serie);

            return $this->redirectToRoute('tvseries');
        }


        return $this->render("serie/new.html.twig",array(
            'serie' => $serie,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/serie/{name}", name="serie_show")
     * @param TvSeries $serie
     * @return Response
     */
    public function showAction(TvSeries $serie)
    {


        return $this->render('serie/info.html.twig', array(
            'serie' => $serie,
            'user' => $this->getUser()

        ));
    }




}
