<?php

namespace App\Service\Admins;

use App\Service\DBConsultas\DBClass;

class ClienteClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function lista()
    {
        $datos = $this->DBClass->clienteLista();
        return $datos;
    }

    public function crear($datos){
        $this->DBClass->clienteCrear($datos);
    }

    public function editar($datos, $id){
        $this->DBClass->clienteEditar($datos, $id);
    }

}
