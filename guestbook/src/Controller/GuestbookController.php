<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Form\GuestbookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guestbook")
 */
class GuestbookController extends AbstractController
{
    /**
     * @Route("/", name="app_guestbook_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $guestbooks = $entityManager
            ->getRepository(Guestbook::class)
            ->findAll();

        return $this->render('guestbook/index.html.twig', [
            'guestbooks' => $guestbooks,
        ]);
    }

    /**
     * @Route("/new", name="app_guestbook_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $guestbook = new Guestbook();
        $form = $this->createForm(GuestbookType::class, $guestbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($guestbook);
            $entityManager->flush();

            return $this->redirectToRoute('app_guestbook_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guestbook/new.html.twig', [
            'guestbook' => $guestbook,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guestbook_show", methods={"GET"})
     */
    public function show(Guestbook $guestbook): Response
    {
        return $this->render('guestbook/show.html.twig', [
            'guestbook' => $guestbook,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_guestbook_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Guestbook $guestbook, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GuestbookType::class, $guestbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_guestbook_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guestbook/edit.html.twig', [
            'guestbook' => $guestbook,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guestbook_delete", methods={"POST"})
     */
    public function delete(Request $request, Guestbook $guestbook, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guestbook->getId(), $request->request->get('_token'))) {
            $entityManager->remove($guestbook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_guestbook_index', [], Response::HTTP_SEE_OTHER);
    }
}
