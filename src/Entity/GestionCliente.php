<?php

namespace App\Entity;

use App\Repository\GestionClienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GestionClienteRepository::class)
 * @ORM\Table(name="gestioncliente")
 */
class GestionCliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="idgestioncliente")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="idGestion")
     */
    private $idGestion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atendido;

    /**
     * @ORM\Column(type="datetime", name="fechaCreacion")
     */
    private $fechaCreacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGestion(): ?int
    {
        return $this->idGestion;
    }

    public function setIdGestion(int $idGestion): self
    {
        $this->idGestion = $idGestion;

        return $this;
    }

    public function getAtendido(): ?bool
    {
        return $this->atendido;
    }

    public function setAtendido(bool $atendido): self
    {
        $this->atendido = $atendido;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }
}
