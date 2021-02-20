<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\MaterielEntree;
use App\Form\MaterielEntreeType;
use App\Repository\MaterielEntreeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/materiel-entree")
 */
class MaterielEntreeController extends AbstractController
{
    /**
     * @Route("/", name="materiel_entree_index", methods={"GET"})
     */
    public function index(MaterielEntreeRepository $materielEntreeRepository): Response
    {
        return $this->render('materiel_entree/index.html.twig', [
            'materiel_entrees' => $materielEntreeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="materiel_entree_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $materielEntree = new MaterielEntree();
        $materiel = new Materiel();
        $form = $this->createForm(MaterielEntreeType::class, $materielEntree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $qte = $form->get('materiel')->getData()->getQte() + $form->get('qteEntree')->getData();
            // dd($qte);

            // $dateEntree = $form->get('materiel')->getData()->getDateEntree();
            // dd($dateEntree);

            // $materiel->setQte($qte);
            // $entityManager->persist($materiel);

            $entityManager->persist($materielEntree);
            $entityManager->flush();
            return $this->redirectToRoute('materiel_entree_index');
        }

        return $this->render('materiel_entree/new.html.twig', [
            'materiel_entree' => $materielEntree,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="materiel_entree_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MaterielEntree $materielEntree): Response
    {
        $form = $this->createForm(MaterielEntreeType::class, $materielEntree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materiel_entree_index');
        }

        return $this->render('materiel_entree/edit.html.twig', [
            'materiel_entree' => $materielEntree,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materiel_entree_delete")
     */
    public function delete(MaterielEntree $materielEntree): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($materielEntree);
        $entityManager->flush();

        return $this->redirectToRoute('materiel_entree_index');
    }
}
