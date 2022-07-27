<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/produits", name="produit_")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("", name="liste")
     */
    public function liste(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();

        return $this->render('produit/liste.html.twig', [
            "produits" => $produits
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->find($id);

        if (!$produit)
            throw $this->createNotFoundException('Pas de produit avec cet identifiant');

        return $this->render('produit/details.html.twig', [
            "produit" => $produit
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $produit = $entityManager->getRepository(Produit::class)->find($id);

        if (!$produit) {
            throw $this->createNotFoundException(
                'Pas de produit avec l\'identifiant '.$id
            );
        }
        $produitForm = $this->createForm(ProduitType::class, $produit);
        $produitForm->handleRequest($request);

        if($produitForm->isSubmitted() && $produitForm->isValid()){
            $entityManager->persist($produit);
            $entityManager->flush();

            $this->addFlash('success', 'Produit modifié avec succès !');
            return $this->redirectToRoute('produit_liste', ['id' => $produit->getId()]);
        }
        $entityManager->flush();

        return $this->render('produit/edit.html.twig', [
            'produitForm' => $produitForm->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Produit $produit, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($produit);
        $entityManager->flush();
        $this->addFlash('success', 'Produit supprimé avec succès !');

        return $this->redirectToRoute('produit_liste');
    }
}
