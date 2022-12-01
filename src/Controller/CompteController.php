<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'compte')]
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [

        ]);
    }
    /**
     * @Route("/compte/edit/modifier", name="compte_profil_modifier")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('messageP', 'Profil mis à jour');
            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
}
