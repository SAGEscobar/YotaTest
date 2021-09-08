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
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $codigoGestion;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nombreGestion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aplicaVisitaTecnica;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $codigoUsuario;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaCreacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigoGestion(): ?string
    {
        return $this->codigoGestion;
    }

    public function setCodigoGestion(string $codigoGestion): self
    {
        $this->codigoGestion = $codigoGestion;

        return $this;
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

    public function getCodigoUsuario(): ?string
    {
        return $this->codigoUsuario;
    }

    public function setCodigoUsuario(string $codigoUsuario): self
    {
        $this->codigoUsuario = $codigoUsuario;

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
