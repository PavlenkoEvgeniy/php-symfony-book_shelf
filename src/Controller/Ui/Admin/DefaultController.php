<?php

namespace App\Controller\Ui\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/ui/admin', name: 'ui_admin_default.index')]
    public function index(): Response
    {
        return $this->redirectToRoute('ui_admin_book.index');
    }
}
