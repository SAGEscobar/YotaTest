<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Gestion;
use App\Entity\GestionCliente;
use App\Entity\Tiket;
use App\Repository\UsuarioRepository;
use App\Repository\GestionRepository;
use App\Repository\GestionClienteRepository;
use App\Repository\TiketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GestionClienteManager;
use App\Service\TiketManager;
use Symfony\Component\HttpFoundation\RequestStack;

class TiketController extends AbstractController
{
    /**
     * @Route("/tiket", name="tiket")
     */
    public function index(GestionRepository $gestionRepository, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        if (!$session->get("login", null)){
            return $this->redirectToRoute('login');   
        }
        $gestiones = $gestionRepository->findAll();
        return $this->render('tiket/index.html.twig', [
            'controller_name' => 'TiketController',
            'gestiones' => $gestiones,
            'user'=>$session->get("nombre", "admin"),
        ]);
    }


    /**
     * @Route("/api/tikets", name="GetTikets")
     */
    public function getTiketes(GestionClienteRepository $gestionClienteRepository, GestionRepository $gestionRepository, RequestStack $requestStack ): Response
    {
        $session = $requestStack->getSession();
        if (!$session->get("login", null)){
            $response = new Response(json_encode(array('error'=>'Acceso denegado')));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(403);

            return $response;
        }
        $gestionesPendientes = $gestionClienteRepository->findBy(array('atendido' => FALSE));
        $gestionesData = $gestionRepository->findAll();
        $gestiones = array();
        foreach($gestionesData as $gestion){
            $gestiones[] = array('id' => $gestion->getId(), 'nombreGestion'=>$gestion->getNombreGestion());
        }
        $arr = array();
        foreach($gestionesPendientes as $gestionPendiente){
            $arr[] = array(
                'id'=>$gestionPendiente->getId(),
                'gestion'=>array_values(array_filter($gestiones, fn($v)=> $v['id'] == $gestionPendiente->getIdGestion()))[0]
            );
        }

        $response = new Response(json_encode(array('success' => "datos solicitados correctamente", 'datos'=>$arr)));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }

    /**
     * @Route("/api/nuevo-tiket-validacion", name="nuevoTiketValidacion")
     */
    public function nuevoTiketValidacion(GestionClienteRepository $gestionClienteRepository, TiketRepository $tiketRepository, TiketManager $tiketManager, GestionClienteManager $gestionClienteManager , Request $request, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        if (!$session->get("login", null)){
            $response = new Response(json_encode(array('error'=>'Acceso denegado')));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(403);

            return $response;
        }
        if(isset($_GET['idGestionCliente'])){
            $idGestionCliente = (int)$_GET['idGestionCliente'];
            $gestionCliente = $gestionClienteRepository->findOneById($idGestionCliente);

            if($gestionCliente){
                if($gestionCliente->getAtendido()){
                    $response = new Response(json_encode(
                        array(
                            'error' => "La gestion ya ha sido atendida"
                        )
                    ));
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setStatusCode(Response::HTTP_LOCKED);

                    return $response;
                }

                //Cambiando atendido a verdadero para evitar que otro usuario trabaje el mismo tiket
                $gestionCliente->setAtendido(True);
                $gestionClienteManager->editar($gestionCliente);

                //Creando nuevo tiket
                $tiket = new Tiket();
                $tiket->setIdGestionCliente($gestionCliente->getId());
                $tiketManager->crear($tiket);

                //Creando respuesta
                $response = new Response(json_encode(
                        array(
                            'success' => "datos solicitados correctamente",
                            'data'=>array(
                                'idtiket'=>$tiket->getId()
                            )
                        )
                    ));
                $response->headers->set('Content-Type', 'application/json');
                $response->setStatusCode(Response::HTTP_CREATED);

                return $response;

            }
            $response = new Response(json_encode(
                array(
                    'error' => "La gestion ya ha sido atendida",
                    'data'=>array(
                        'idtiket'=>$tiket->getId()
                    )
                )
            ));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(Response::HTTP_LOCKED);

            return $response;
        }

        
        $gestiones = $gestionRepository->findAll();
        return $this->render('tiket/index.html.twig', [
            'controller_name' => 'TiketController',
            'gestiones' => $gestiones,
        ]);
    }

    /**
     * @Route("/api/nuevo-tiket", name="nuevoTiket")
     */
    public function nuevoTiket(TiketRepository $tiketRepository, TiketManager $tiketManager, Request $request, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        if (!$session->get("login", null)){
            $response = new Response(json_encode(array('error'=>'Acceso denegado')));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(403);

            return $response;
        }
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
        $gestion = (int)filter_var($_POST['gestion'], FILTER_SANITIZE_STRING);
        $problema = filter_var($_POST['problema'], FILTER_SANITIZE_STRING);
        $solucion = filter_var($_POST['solucion'], FILTER_SANITIZE_STRING);
        $tiketId = (int)filter_var($_POST['tiketId'], FILTER_SANITIZE_STRING);

        if(true){
            $tiket = $tiketRepository->findOneById($tiketId);

            if($tiket){
                //Creando nuevo tiket
                $tiket->setNombreCliente($nombre);
                $tiket->setApellidoCliente($apellido);
                $tiket->setDireccionCliente($direccion);
                $tiket->setTelefonoCliente($telefono);
                $tiket->setCodigoGestion($gestion);
                $tiket->setProblemaExpuesto($problema);
                $tiket->setSolucionBrindada($solucion);
                $tiketManager->editar($tiket);

                //Creando respuesta
                $response = new Response(json_encode(
                        array(
                            'success' => "datos solicitados correctamente",
                            'data'=>array(
                                'idtiket'=>$tiket->getId()
                            )
                        )
                    ));
                $response->headers->set('Content-Type', 'application/json');
                $response->setStatusCode(Response::HTTP_CREATED);

                return $response;

            }
            $response = new Response(json_encode(
                array(
                    'error' => "La gestion ya ha sido atendida",
                    'data'=>array(
                        'idtiket'=>$tiket->getId()
                    )
                )
            ));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(Response::HTTP_LOCKED);

            return $response;
        }

        
        $gestiones = $gestionRepository->findAll();
        return $this->render('tiket/index.html.twig', [
            'controller_name' => 'TiketController',
            'gestiones' => $gestiones,
        ]);
    }

}
