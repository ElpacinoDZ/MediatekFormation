<?php

namespace App\Controller\admin\categories;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoriesController extends AbstractController
{
    private $categorieRepository;
    private $formationRepository;

    public function __construct(CategorieRepository $categorieRepository, FormationRepository $formationRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->formationRepository = $formationRepository;
    }

    #[Route('/admin/categories', name: 'admin.categories')]
    public function index(): Response
    {
        $categories = $this->categorieRepository->findAll();

        return $this->render('admin/categories/admin.categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/categories/add', name: 'admin.categories.add')]
    public function add(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('admin.categories');
        }

        return $this->render('admin/categories/admin.categories_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/categories/edit/{id}', name: 'admin.categories.edit')]
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin.categories');
        }

        return $this->render('admin/categories/admin.categories_edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/categories/delete/{id}', name: 'admin.categories.delete')]
    public function delete(Categorie $categorie): Response
    {
        $totalVideos = count($categorie->getFormations());

        if ($totalVideos === 0) {
            $this->categorieRepository->remove($categorie, true);
        } else {
            $this->addFlash('error', 'Impossible de supprimer la catégorie car celle-ci n\'est pas vide');
        }

        return $this->redirectToRoute('admin.categories');
    }
}