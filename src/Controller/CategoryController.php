<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategoryRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/categories", name="categorie_")
 */
class CategoryController extends AbstractController
{

    /**
     * @Route("", name="liste")
     */
    public function categorie(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('categorie/liste.html.twig', [
            "categories" => $categories
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, CategoryRepository $categoryRepository): Response
    {
        $categorie = $categoryRepository->find($id);

        if (!$categorie)
            throw $this->createNotFoundException('Pas de catégorie avec cet identifiant');

        return $this->render('categorie/details.html.twig', [
            "categorie" => $categorie
        ]);
    }
}
