<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {

        $userName = $request->query->get('user');

    if ($userName) {
        // Articles publiés de l'utilisateur connecté
        $articles = $articleRepository->findPublishedByUserNameString($userName);
    } else {
        // Tous les articles publiés (ou [] si tu veux rien pour les non-connectés)
        $articles = $articleRepository->findAllPublished();
    }
        $categories = $categoryRepository -> findAll();

        return $this->render('pages/home/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
