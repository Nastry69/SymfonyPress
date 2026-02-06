<?php

namespace App\Controller;

use App\Entity\User;
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
        $searchedUserName = $request->query->get('user');

        if (!empty($searchedUserName)) {
            // 🟡 Filtre par nom d'auteur (string)
            $articles = $articleRepository->findPublishedByUserNameString($searchedUserName);
        } else {
            // 🟢 Pas de filtre → tous les articles publiés
            $articles = $articleRepository->findAllPublished();
        }
        $categories = $categoryRepository -> findAll();

        return $this->render('pages/home/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
