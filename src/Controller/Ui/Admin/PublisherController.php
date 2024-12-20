<?php

namespace App\Controller\Ui\Admin;

use App\Entity\Publisher;
use App\Form\PublisherType;
use App\Repository\PublisherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublisherController extends AbstractController
{
    #[Route('/ui/admin/publisher', name: 'ui_admin_publisher.index', methods: [Request::METHOD_GET])]
    public function index(PublisherRepository $publisherRepository): Response
    {
        return $this->render('ui/admin/publisher/index.html.twig', [
            'publishers' => $publisherRepository->findAll(),
        ]);
    }

    #[Route('/ui/admin/publisher/new', name: 'ui_admin_publisher.new', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publisher = new Publisher();
        $form      = $this->createForm(PublisherType::class, $publisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($publisher);
            $entityManager->flush();

            return $this->redirectToRoute('ui_admin_publisher.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ui/admin/publisher/new.html.twig', [
            'publisher' => $publisher,
            'form'      => $form,
        ]);
    }

    #[Route('/ui/admin/publisher/{id}', name: 'ui_admin_publisher.show', methods: [Request::METHOD_GET])]
    public function show(Publisher $publisher): Response
    {
        return $this->render('ui/admin/publisher/show.html.twig', [
            'publisher' => $publisher,
        ]);
    }

    #[Route('/ui/admin/publisher/{id}/edit', name: 'ui_admin_publisher.edit', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function edit(Request $request, Publisher $publisher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PublisherType::class, $publisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ui_admin_publisher.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ui/admin/publisher/edit.html.twig', [
            'publisher' => $publisher,
            'form'      => $form,
        ]);
    }

    #[Route('/ui/admin/publisher/{id}', name: 'ui_admin_publisher.delete', methods: [Request::METHOD_POST])]
    public function delete(Request $request, Publisher $publisher, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publisher->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($publisher);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ui_admin_publisher.index', [], Response::HTTP_SEE_OTHER);
    }
}
