<?php

namespace App\Service;

use App\Entity\GestionCliente;
use App\Repository\GestionClienteRepository;
use Doctrine\ORM\EntityManagerInterface;

class GestionClienteManager{
  private $em;
  private $gestionClienteRepository;

  public function __construct(GestionClienteRepository $gestionClienteRepository, EntityManagerInterface $em){
    $this->em = $em;
    $this->gestionClienteRepository = $gestionClienteRepository;
  }

  public function crear(GestionCliente $gestionCliente){
    $this->em->persist($gestionCliente);
    $this->em->flush();
  }

  public function editar(GestionCliente $gestionCliente):void
  {
    $this->em->flush();
  }

  public function eliminar(GestionCliente $gestionCliente):void
  {
    $this->em->remove($gestionCliente);
    $this->em->flush();
  }

  public function validar(GestionCliente $gestionCliente){
    $errores = [];
    if(empty($gestionCliente->getDescription())){
      $errores[] = 'El campo descripcion es obligatorio';
    }
    return $errores;
  }
}