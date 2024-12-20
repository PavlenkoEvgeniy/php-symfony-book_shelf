<?php

namespace App\Controller\Ui\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/ui/admin/author', name: 'ui_admin_author.index', methods: [Request::METHOD_GET])]
    public function index(AuthorRepository $authorRepository): Response
    {
        return $this->render('ui/admin/author/index.html.twig', [
            'authors' => $authorRepository->findAll(),
        ]);
    }

    #[Route('/ui/admin/author/new', name: 'ui_admin_author.new', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $author = new Author();
        $form   = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('ui_admin_author.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ui/admin/author/new.html.twig', [
            'author' => $author,
            'form'   => $form,
        ]);
    }

    #[Route('/ui/admin/author/{id}', name: 'ui_admin_author.show', methods: [Request::METHOD_GET])]
    public function show(Author $author): Response
    {
        return $this->render('ui/admin/author/show.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/ui/admin/author/{id}/edit', name: 'ui_admin_author.edit', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function edit(Request $request, Author $author, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($author);

            $entityManager->flush();

            return $this->redirectToRoute('ui_admin_author.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ui/admin/author/edit.html.twig', [
            'author' => $author,
            'form'   => $form,
        ]);
    }

    #[Route('/ui/admin/author/{id}', name: 'ui_admin_author.delete', methods: [Request::METHOD_POST])]
    public function delete(Request $request, Author $author, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $author->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($author);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ui_admin_author.index', [], Response::HTTP_SEE_OTHER);
    }
}
