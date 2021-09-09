<?php

namespace App\Entity;

use App\Repository\GestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GestionRepository::class)
 */
class Gestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="idgestion")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70, name="nombreGestion")
     */
    private $nombreGestion;

    /**
     * @ORM\Column(type="boolean", name="aplicaVisitaTecnica")
     */
    private $aplicaVisitaTecnica;

    /**
     * @ORM\Column(type="integer", length=45, name="idUsuario")
     */
    private $idUsuario;

    /**
     * @ORM\Column(type="datetime", name="fechaCreacion")
     */
    private $fechaCreacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreGestion(): ?string
    {
        return $this->nombreGestion;
    }

    public function setNombreGestion(string $nombreGestion): self
    {
        $this->nombreGestion = $nombreGestion;

        return $this;
    }

    public function getAplicaVisitaTecnica(): ?bool
    {
        return $this->aplicaVisitaTecnica;
    }

    public function setAplicaVisitaTecnica(bool $aplicaVisitaTecnica): self
    {
        $this->aplicaVisitaTecnica = $aplicaVisitaTecnica;

        return $this;
    }

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $codigoUsuario): self
    {
        $this->idUsuario = $idUsuario;

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
