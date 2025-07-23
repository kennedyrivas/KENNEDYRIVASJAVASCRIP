<?php

namespace App\Service\Admins;

use App\Service\DBConsultas\DBClass;

class UserClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function adminLista(){
        $datos = $this->DBClass->userAdminLista();
        return $datos;
    }

    public function vendeLista(){
        $datos = $this->DBClass->userVendeLista();
        return $datos;
    }

    public function crear($datos, $rol){
        $this->DBClass->userCrear($datos, $rol);
    }

    public function editar($datos, $rol, $id){
        $this->DBClass->userEditar($datos, $rol, $id);
    }

    
}
