<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Episode;
use AppBundle\Entity\UserEpisode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Episode controller.
 *
 * @Route("episode")
 */
class EpisodeController extends Controller
{
    /**
     * Lists all episode entities.
     *
     * @Route("/", name="episode_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $episodes = $em->getRepository('AppBundle:Episode')->findAll();

        return $this->render('episode/index.html.twig', array(
            'episodes' => $episodes,
        ));
    }

    /**
     * Creates a new episode entity.
     *
     * @Route("/new", name="episode_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $episode = new Episode();
        $form = $this->createForm('AppBundle\Form\EpisodeType', $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $episode->getSerie()->addEpisode($episode);
            $em->persist($episode);
            $em->flush($episode);

            return $this->redirectToRoute('episode_show', array('id' => $episode->getId()));
        }

        return $this->render('episode/new.html.twig', array(
            'episode' => $episode,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a episode entity.
     *
     * @Route("/{id}", name="episode_show")
     * @Method("GET")
     */
    public function showAction(Episode $episode)
    {
        $deleteForm = $this->createDeleteForm($episode);

        return $this->render('episode/show.html.twig', array(
            'episode' => $episode,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing episode entity.
     *
     * @Route("/{id}/edit", name="episode_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Episode $episode)
    {
        $deleteForm = $this->createDeleteForm($episode);
        $editForm = $this->createForm('AppBundle\Form\EpisodeType', $episode);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('episode_edit', array('id' => $episode->getId()));
        }

        return $this->render('episode/edit.html.twig', array(
            'episode' => $episode,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a episode entity.
     *
     * @Route("/{id}", name="episode_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Episode $episode)
    {
        $form = $this->createDeleteForm($episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($episode);
            $em->flush($episode);
        }

        return $this->redirectToRoute('episode_index');
    }

    /**
     * Creates a form to delete a episode entity.
     *
     * @param Episode $episode The episode entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Episode $episode)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('episode_delete', array('id' => $episode->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     *
     * @Route("/seen/{id}", name="episode_seen")
     * @Method("POST")
     */
    public function seenAction(Episode $episode)
    {
        $user = $this->getUser();
        $userEpisode = new UserEpisode();
        $userEpisode->setEpisodeId($episode);
        $userEpisode->setUserId($user);
        $userEpisode->setWatchedAt(new \DateTime());
        $userEpisode->setCurrent("false");
        $em = $this->getDoctrine()->getManager();
        $episode->addUserEpisode($userEpisode);
        $em->persist($userEpisode);
        $em->merge($episode);
        $em->flush();

        return $this->redirectToRoute('tvseries');
    }

}
