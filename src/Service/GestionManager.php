<?php

namespace App\Service;

use App\Entity\Gestion;
use App\Repository\GestionRepository;
use Doctrine\ORM\EntityManagerInterface;

class GestionManager{
  private $em;
  private $gestionRepository;

  public function __construct(GestionRepository $gestionRepository, EntityManagerInterface $em){
    $this->em = $em;
    $this->gestionRepository = $gestionRepository;
  }

  public function crear(Gestion $gestion){
    $this->em->persist($gestion);
    $this->em->flush();
  }

  public function editar(Gestion $gestion):void
  {
    $this->em->flush();
  }

  public function eliminar(Gestion $gestion):void
  {
    $this->em->remove($gestion);
    $this->em->flush();
  }

  public function validar(Gestion $gestion){
    $errores = [];
    if(empty($gestion->getDescription())){
      $errores[] = 'El campo descripcion es obligatorio';
    }
    return $errores;
  }
}