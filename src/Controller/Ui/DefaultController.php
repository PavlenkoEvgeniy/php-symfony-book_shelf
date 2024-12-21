<?php

namespace App\Controller\Ui;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'ui_default.index')]
    public function index(): Response
    {
        return $this->redirectToRoute('ui_book_shelf.index');
    }
}
