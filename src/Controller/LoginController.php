<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    /**
     * @Route("/validatelogin", name="validate_login")
     */
    public function validateLogin(UsuarioRepository $UsuarioRepository, RequestStack $requestStack, Request $request): Response{
        $login = $request->request->get('login', null);
        $password = $request->request->get('password', null);
        if($login && $password){
            $user = $UsuarioRepository->findOneBy(['login'=>$login]);
            if($user){
                if($user->getPassword() == $password){
                    $session = $requestStack->getSession();
                    
                    $session->set("id",$user->getId());
                    $session->set("login",$user->getLogin());
                    $session->set("nombre",$user->getNombreUsuario()." ".$user->getApellidoUsuario());
                    return $this->redirectToRoute("gestiones");
                }else{
                    return $this->redirectToRoute("login");
                }
            }else{
                return $this->redirectToRoute("login");
            }
        }else{
            return $this->redirectToRoute("login");
        }
        
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function Logout(UsuarioRepository $UsuarioRepository, RequestStack $requestStack, Request $request): Response{
        $session = $requestStack->getSession();
        $session->clear();
        $session->invalidate();
        return $this->redirectToRoute("login");
    }
}
