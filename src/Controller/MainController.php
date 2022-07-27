<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_accueil")
     */
    public function accueil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $produit->setDateAjout(new \DateTime());

        $produitForm = $this->createForm(ProduitType::class, $produit);

        $produitForm->handleRequest($request);

        if($produitForm->isSubmitted()){
            $entityManager->persist($produit);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès !');
            return $this->redirectToRoute('produit_details', ['id' => $produit->getId()]);
        }

        return $this->render('main/accueil.html.twig', [
            'produitForm' => $produitForm->createView()
        ]);
    }
}