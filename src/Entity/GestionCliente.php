<?php

namespace App\Entity;

use App\Repository\GestionClienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GestionClienteRepository::class)
 */
class GestionCliente
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
     * @ORM\Column(type="boolean")
     */
    private $atendido;

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
