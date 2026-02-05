<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


#[Route('/admin/article', name: 'admin_article_')]
final class ArticleController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            // ADMIN → voit TOUS les articles
            $articles = $articleRepository->findBy(
                [],
                ['createdAt' => 'DESC']
            );
        } else {
            // USER → ne voit QUE ses articles
            $articles = $articleRepository->findBy(
                ['user' => $this->getUser()],
                ['createdAt' => 'DESC']
            );
        }

        return $this->render('pages/admin/article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        $article = new Article();
        // createdAt géré pour les nouveaux articles
        $article->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article->setUser($this->getUser());
            $article->setIsPublished(true);

            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $uploadsDir = $this->getParameter('uploads_directory');

                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move($uploadsDir, $newFilename);

                $article->setImage($newFilename);
            }
            // slug auto à partir du titre
            $slug = $slugger->slug($article->getTitle())->lower();
            $article->setSlug($slug);

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article créé avec succès.');

            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('pages/admin/article/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Article $article,
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        if (
            !$this->isGranted('ROLE_ADMIN')
            && $article->getUser() !== $this->getUser()
        ) {
            throw $this->createAccessDeniedException();
        }
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $uploadsDir = $this->getParameter('uploads_directory');

                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move($uploadsDir, $newFilename);

                $article->setImage($newFilename);
            }
            $slug = $slugger->slug($article->getTitle())->lower();
            $article->setSlug($slug);

            $em->flush();

            $this->addFlash('success', 'Article mis à jour avec succès.');

            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('pages/admin/article/edit.html.twig', [
            'form'    => $form,
            'article' => $article,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(
        Article $article,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        if (
            !$this->isGranted('ROLE_ADMIN')
            && $article->getUser() !== $this->getUser()
        ) {
            throw $this->createAccessDeniedException();
        }
        if ($this->isCsrfTokenValid('delete_article_' . $article->getId(), $request->request->get('_token'))) {
            $em->remove($article);
            $em->flush();
            $this->addFlash('success', 'Article supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_article_index');
    }
}
