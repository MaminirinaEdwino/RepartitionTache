<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Employes;
use App\Form\RegistrationAdminFormType;
use App\Form\RegistrationEmployesFormType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registerEmployes', name: 'app_register_employes')]
    public function registerEmployes(Request $request, UserPasswordHasherInterface $employePasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $employe = new Employes();
        $form = $this->createForm(RegistrationEmployesFormType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $employe->setPassword(
                $employePasswordHasher->hashPassword(
                    $employe,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($employe);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('registration/registerEmployes.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/registerAdmin', name: 'app_register_Admin')]
    public function registerAdmin(Request $request, UserPasswordHasherInterface $employePasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $employe = new Admin();
        $form = $this->createForm(RegistrationAdminFormType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $employe->setPassword(
                $employePasswordHasher->hashPassword(
                    $employe,
                    $form->get('plainPassword')->getData()
                )
            );
            $employe->setRoles(['ROLE_ADMIN']);

            $entityManager->persist($employe);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('registration/registerAdmin.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
