<?php

namespace App\Controller;

use App\Entity\SousType;
use App\Form\SousTypeType;
use App\Repository\SousTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous-type")
 */
class SousTypeController extends AbstractController
{
    /**
     * @Route("/", name="sous_type_index", methods={"GET"})
     */
    public function index(SousTypeRepository $sousTypeRepository): Response
    {
        return $this->render('sous_type/index.html.twig', [
            'sous_types' => $sousTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="sous_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousType = new SousType();
        $form = $this->createForm(SousTypeType::class, $sousType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousType);
            $entityManager->flush();

            return $this->redirectToRoute('sous_type_index');
        }

        return $this->render('sous_type/new.html.twig', [
            'sous_type' => $sousType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousType $sousType): Response
    {
        $form = $this->createForm(SousTypeType::class, $sousType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_type_index');
        }

        return $this->render('sous_type/edit.html.twig', [
            'sous_type' => $sousType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_type_delete")
     */
    public function delete(SousType $sousType): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($sousType);
        $entityManager->flush();

        return $this->redirectToRoute('sous_type_index');
    }
}
