<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionesController extends AbstractController
{
    /**
     * @Route("/gestiones", name="gestiones")
     */
    public function index(UsuarioRepository $UsuarioRepository): Response
    {
        // session_start();
        // if (isset($_SESSION["anuma"])){
        //     unset($_SESSION['anuma']);
        $user = $UsuarioRepository->findOneById(1);
            return $this->render('gestiones/index.html.twig', [
                'controller_name' => 'GestionesController',
                'User' => $user,
            ]);
        // }else{
        //     $_SESSION["anuma"] = true;
        //     return $this->redirectToRoute('login');

        // }
    }
}
