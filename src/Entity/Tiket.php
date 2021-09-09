<?php

namespace App\Entity;

use App\Repository\TiketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TiketRepository::class)
 */
class Tiket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="idTiket")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=45, name="idGestionCliente")
     */
    private $idGestionCliente;

    /**
     * @ORM\Column(type="string", length=70, name="nombreCliente", nullable=true)
     */
    private $nombreCliente;

    /**
     * @ORM\Column(type="string", length=70, name="apellidoCliente", nullable=true)
     */
    private $apellidoCliente;

    /**
     * @ORM\Column(type="string", length=200, name="direccionCliente", nullable=true)
     */
    private $direccionCliente;

    /**
     * @ORM\Column(type="string", length=20, name="telefonoCliente", nullable=true)
     */
    private $telefonoCliente;

    /**
     * @ORM\Column(type="integer", length=45, name="idGestion", nullable=true)
     */
    private $idGestion;

    /**
     * @ORM\Column(type="text", name="problemaExpuesto", nullable=true)
     */
    private $problemaExpuesto;

    /**
     * @ORM\Column(type="text", name="solucionBrindada", nullable=true)
     */
    private $solucionBrindada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGestionCliente(): ?int
    {
        return $this->IdGestionCliente;
    }

    public function setIdGestionCliente(int $idGestionCliente): self
    {
        $this->idGestionCliente = $idGestionCliente;

        return $this;
    }

    public function getNombreCliente(): ?string
    {
        return $this->nombreCliente;
    }

    public function setNombreCliente(string $nombreCliente): self
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    public function getApellidoCliente(): ?string
    {
        return $this->apellidoCliente;
    }

    public function setApellidoCliente(string $apellidoCliente): self
    {
        $this->apellidoCliente = $apellidoCliente;

        return $this;
    }

    public function getDireccionCliente(): ?string
    {
        return $this->direccionCliente;
    }

    public function setDireccionCliente(string $direccionCliente): self
    {
        $this->direccionCliente = $direccionCliente;

        return $this;
    }

    public function getTelefonoCliente(): ?string
    {
        return $this->telefonoCliente;
    }

    public function setTelefonoCliente(string $telefonoCliente): self
    {
        $this->telefonoCliente = $telefonoCliente;

        return $this;
    }

    public function getIdGestion(): ?int
    {
        return $this->idGestion;
    }

    public function setCodigoGestion(int $idGestion): self
    {
        $this->idGestion = $idGestion;

        return $this;
    }

    public function getProblemaExpuesto(): ?string
    {
        return $this->problemaExpuesto;
    }

    public function setProblemaExpuesto(string $problemaExpuesto): self
    {
        $this->problemaExpuesto = $problemaExpuesto;

        return $this;
    }

    public function getSolucionBrindada(): ?string
    {
        return $this->solucionBrindada;
    }

    public function setSolucionBrindada(string $solucionBrindada): self
    {
        $this->solucionBrindada = $solucionBrindada;

        return $this;
    }
}
