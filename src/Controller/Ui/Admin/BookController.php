<?php

namespace App\Controller\Ui\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/ui/admin/book', name: 'ui_admin_book.index', methods: [Request::METHOD_GET])]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('ui/admin/book/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/ui/admin/book/new', name: 'ui_admin_book.new', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('ui_admin_book.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ui/admin/book/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/ui/admin/book/{id}', name: 'ui_admin_book.show', methods: [Request::METHOD_GET])]
    public function show(Book $book): Response
    {
        return $this->render('ui/admin/book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/ui/admin/book/{id}/edit', name: 'ui_admin_book.edit', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function edit(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ui_admin_book.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ui/admin/book/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/ui/admin/book/{id}', name: 'ui_admin_book.delete', methods: [Request::METHOD_POST])]
    public function delete(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $book->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ui_admin_book.index', [], Response::HTTP_SEE_OTHER);
    }
}
