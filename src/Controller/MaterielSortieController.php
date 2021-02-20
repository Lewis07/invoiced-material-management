<?php

namespace App\Controller;

use App\Entity\MaterielSortie;
use App\Form\MaterielSortieType;
use App\Repository\MaterielSortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/materiel-sortie")
 */
class MaterielSortieController extends AbstractController
{
    /**
     * @Route("/", name="materiel_sortie_index", methods={"GET"})
     */
    public function index(MaterielSortieRepository $materielSortieRepository): Response
    {
        return $this->render('materiel_sortie/index.html.twig', [
            'materiel_sorties' => $materielSortieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="materiel_sortie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $materielSortie = new MaterielSortie();
        $form = $this->createForm(MaterielSortieType::class, $materielSortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materielSortie);
            $entityManager->flush();

            return $this->redirectToRoute('materiel_sortie_index');
        }

        return $this->render('materiel_sortie/new.html.twig', [
            'materiel_sortie' => $materielSortie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="materiel_sortie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MaterielSortie $materielSortie): Response
    {
        $form = $this->createForm(MaterielSortieType::class, $materielSortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materiel_sortie_index');
        }

        return $this->render('materiel_sortie/edit.html.twig', [
            'materiel_sortie' => $materielSortie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materiel_sortie_delete")
     */
    public function delete(Request $request, MaterielSortie $materielSortie): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($materielSortie);
        $entityManager->flush();

        return $this->redirectToRoute('materiel_sortie_index');
    }
}
