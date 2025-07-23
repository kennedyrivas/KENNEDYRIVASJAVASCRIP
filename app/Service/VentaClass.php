<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class VentaClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function Cliente($cedula)
    {
        $cliente = $this->DBClass->clienteBuscarXCedula($cedula);
        return $cliente;
    }

    public function producto($codigoBarra)
    {
        $producto = $this->DBClass->productoBuscarXCodigoBarra($codigoBarra);
        $porcentajeDecimal = floatval($producto->porcentajeGanancia) / 100;
        $producto->precio = round($producto->costo * (1 + $porcentajeDecimal), 2);
        return $producto;
    }

    
}