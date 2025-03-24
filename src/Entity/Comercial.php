<?php

namespace App\Entity;

use App\Repository\ComercialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComercialRepository::class)]
class Comercial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaVenta = null;

    #[ORM\Column]
    private ?bool $vendido = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $precioOferta = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $precioFinal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFechaVenta(): ?\DateTimeInterface
    {
        return $this->fechaVenta;
    }

    public function setFechaVenta(\DateTimeInterface $fechaVenta): static
    {
        $this->fechaVenta = $fechaVenta;

        return $this;
    }

    public function isVendido(): ?bool
    {
        return $this->vendido;
    }

    public function setVendido(bool $vendido): static
    {
        $this->vendido = $vendido;

        return $this;
    }

    public function getPrecioOferta(): ?string
    {
        return $this->precioOferta;
    }

    public function setPrecioOferta(string $precioOferta): static
    {
        $this->precioOferta = $precioOferta;

        return $this;
    }

    public function getPrecioFinal(): ?string
    {
        return $this->precioFinal;
    }

    public function setPrecioFinal(string $precioFinal): static
    {
        $this->precioFinal = $precioFinal;

        return $this;
    }
}
