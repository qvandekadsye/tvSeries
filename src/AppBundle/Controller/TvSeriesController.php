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
        $deleteForm = $this->createDeleteForm($serie);


        return $this->render('serie/info.html.twig', array(
            'serie' => $serie,
            'user' => $this->getUser(),
            'delete_form' => $deleteForm->createView()

        ));
    }


    /**
     * Deletes a tv_series entity.
     *
     * @Route("/{id}", name="serie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TvSeries $serie)
    {
        $form = $this->createDeleteForm($serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($serie);
            $em->flush($serie);
        }

        return $this->redirectToRoute('tvseries');
    }

    /**
     * Creates a form to delete a episode entity.
     *
     * @param Episode $episode The episode entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TvSeries $series)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('serie_delete', array('id' => $series->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }




}
