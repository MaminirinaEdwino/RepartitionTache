<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }
        else{
            $role = $user->getRoles();
            if ($role[0] == 'ROLE_ADMIN' ) {
                return $this->render('homepage/indexAdmin.html.twig', [
                    'user' => $user,
                ]);
            }
            if ($role[0] == 'ROLE_USER') {
                return $this->render('homepage/indexEmployes.html.twig', [
                    'user' => $user,
                ]);
            }
        }
    }
}
