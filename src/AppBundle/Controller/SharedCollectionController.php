<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SharedCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sharedcollection controller.
 *
 * @Route("sharedcollection")
 */
class SharedCollectionController extends Controller
{
    /**
     * Lists all sharedCollection entities.
     *
     * @Route("/", name="sharedcollection_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sharedCollections = $em->getRepository('AppBundle:SharedCollection')->findAll();

        return $this->render('sharedcollection/index.html.twig', array(
            'sharedCollections' => $sharedCollections,
        ));
    }

    /**
     * Creates a new sharedCollection entity.
     *
     * @Route("/new", name="sharedcollection_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sharedCollection = new Sharedcollection();
        $form = $this->createForm('AppBundle\Form\SharedCollectionType', $sharedCollection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sharedCollection);
            $em->flush();

            return $this->redirectToRoute('sharedcollection_show', array('id' => $sharedCollection->getId()));
        }

        return $this->render('sharedcollection/new.html.twig', array(
            'sharedCollection' => $sharedCollection,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sharedCollection entity.
     *
     * @Route("/{id}", name="sharedcollection_show")
     * @Method("GET")
     */
    public function showAction(SharedCollection $sharedCollection)
    {
        $deleteForm = $this->createDeleteForm($sharedCollection);

        return $this->render('sharedcollection/show.html.twig', array(
            'sharedCollection' => $sharedCollection,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sharedCollection entity.
     *
     * @Route("/{id}/edit", name="sharedcollection_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SharedCollection $sharedCollection)
    {
        $deleteForm = $this->createDeleteForm($sharedCollection);
        $editForm = $this->createForm('AppBundle\Form\SharedCollectionType', $sharedCollection);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sharedcollection_edit', array('id' => $sharedCollection->getId()));
        }

        return $this->render('sharedcollection/edit.html.twig', array(
            'sharedCollection' => $sharedCollection,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sharedCollection entity.
     *
     * @Route("/{id}", name="sharedcollection_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SharedCollection $sharedCollection)
    {
        $form = $this->createDeleteForm($sharedCollection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sharedCollection);
            $em->flush();
        }

        return $this->redirectToRoute('sharedcollection_index');
    }

    /**
     * Creates a form to delete a sharedCollection entity.
     *
     * @param SharedCollection $sharedCollection The sharedCollection entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SharedCollection $sharedCollection)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sharedcollection_delete', array('id' => $sharedCollection->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
