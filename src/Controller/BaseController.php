<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\AjoutBonbonType;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
    }

    #[Route('/ajoutBonbon', name: 'app_ajoutBonbon')]
    public function ajoutBonbon(Request $request): Response
    {
        $form = $this->CreateForm(AjoutBonbonType::class);
        
        if ($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()) {
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_ajoutBonbon');
            }
        }

        return $this->render('base/ajoutBonbon.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
