<?php

namespace App\Controller\Ui;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookShelfController extends AbstractController
{
    #[Route('/ui/book-shelf', name: 'ui_book_shelf.index')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        return $this->render('ui/book_shelf/index.html.twig', [
            'books' => $books,
        ]);
    }
}
