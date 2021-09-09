<?php

namespace App\Service;

use App\Entity\Tiket;
use App\Repository\TiketRepository;
use Doctrine\ORM\EntityManagerInterface;

class TiketManager{
  private $em;
  private $tiketRepository;

  public function __construct(TiketRepository $tiketRepository, EntityManagerInterface $em){
    $this->em = $em;
    $this->tiketRepository = $tiketRepository;
  }

  public function crear(Tiket $tiket){
    $this->em->persist($tiket);
    $this->em->flush();
  }

  public function editar(Tiket $tiket):void
  {
    $this->em->flush();
  }

  public function eliminar(Tiket $tiket):void
  {
    $this->em->remove($tiket);
    $this->em->flush();
  }

  public function validar(Tiket $tiket){
    $errores = [];
    if(empty($tiket->getDescription())){
      $errores[] = 'El campo descripcion es obligatorio';
    }
    return $errores;
  }
}