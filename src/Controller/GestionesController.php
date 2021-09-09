<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Gestion;
use App\Entity\GestionCliente;
use App\Repository\UsuarioRepository;
use App\Repository\GestionRepository;
use App\Repository\GestionClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GestionClienteManager;

class GestionesController extends AbstractController
{
    /**
     * @Route("/gestiones", name="gestiones")
     */
    public function index(GestionRepository $gestionRepository, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        if (!$session->get("login", null)){
            return $this->redirectToRoute('login');
            
        }
        $gestiones = $gestionRepository->findAll();
            return $this->render('gestiones/index.html.twig', [
                'controller_name' => 'GestionesController',
                'gestiones' => $gestiones,
                'user'=>$session->get("nombre", "admin"),
            ]);
        // }else{
        //     $_SESSION["anuma"] = true;
        //     return $this->redirectToRoute('login');

        // }
    }
    /**
     * @Route("/api/nueva-gestion-cliente", name="nuevaGestionCliente",  methods={"GET"})
     */
    public function newGestionCliente(GestionRepository $gestionRepository, RequestStack $requestStack, GestionClienteManager $em, Request $request): Response
    {
        // $session = $requestStack->getSession();
        // if (!$session->get("login", null)){
        //     return $this->redirectToRoute('login');
            
        // }
        $session = $requestStack->getSession();
        if (!$session->get("login", null)){
            $response = new Response(json_encode(array('error'=>'Acceso denegado')));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(403);

            return $response;
        }
        if(isset($_GET['idGestion'])){
            $idGestion = (int)$_GET['idGestion'];

            $gestionCliente = new GestionCliente();
            $gestionCliente->setIdGestion($idGestion);
            $gestionCliente->setAtendido(FALSE);
            $gestionCliente->setFechaCreacion(new \DateTime('NOW'));

            $em->crear($gestionCliente);

            $response = new Response(json_encode(array('success'=>'Creado con exito', 'id'=>$gestionCliente->getId())));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(Response::HTTP_CREATED);

            return $response;
        }
        $response = new Response(json_encode(array('fail' => "Error obteniendo la gestion")));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);

        return $response;
        // $gestiones = $gestionRepository->findAll();
        //     return $this->render('gestiones/index.html.twig', [
        //         'controller_name' => 'GestionesController',
        //         'gestiones' => $gestiones,
        //     ]);
        // }else{
        //     $_SESSION["anuma"] = true;
        //     return $this->redirectToRoute('login');

        // }
    }
}
