<?php

namespace App\Service\DBConsultas;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DBClass
{
    // Users
        // Lista
            // Admin
            public function userAdminLista(){
                $tipos = ['Admin', 'SuperAdmin'];
                $datos = User::whereIn('tipo', $tipos)->get();
                return $datos;
            }

            // Vendedor
            public function userVendeLista(){
                $datos = User::where('tipo', 'Vendedor')->get();
                return $datos;
            }

        // Crear
        public function userCrear($datos, $rol){
            $use = new User();
            $use->name = $datos['nombre'];
            $use->apellido = $datos['apellido'];
            $use->cedula = $datos['cedula'];
            $use->telefono = $datos['telefono'];
            $use->tipo = $rol;
            $use->email = $datos['email'];
            $use->password = Hash::make($datos['password']);
            $use->assignRole($rol);
            $use->save();
        }
        // Editar
        public function userEditar($datos, $rol, $id){
            $id->name = $datos['nombre'];
            $id->apellido = $datos['apellido'];
            $id->cedula = $datos['cedula'];
            $id->telefono = $datos['telefono'];
            $id->tipo = $rol;
            $id->email = $datos['email'];
            $id->password = Hash::make($datos['password']);
            $id->assignRole($rol);
            $id->save();
        }

    // Clientes
        // Lista
        public function clienteLista(){
            $datos = Cliente::all();
            return $datos;
        }

        // Crear
        public function clienteCrear($datos){
            Cliente::create([
                'nombre' => $datos['nombre'],
                'apellido' => $datos['apellido'],
                'cedula' => $datos['cedula'],
                'telefono' => $datos['telefono'],
                'email' => $datos['email'],
                'direccion' => $datos['direccion'],
            ]);
        }

        // Editar
        public function clienteEditar($datos, $id){
            $id->nombre = $datos['nombre'];
            $id->apellido = $datos['apellido'];
            $id->cedula = $datos['cedula'];
            $id->telefono = $datos['telefono'];
            $id->email = $datos['email'];
            $id->direccion = $datos['direccion'];
            $id->save();
        }

        // Buscar
            // Por Cedula
            public function clienteBuscarXCedula($cedula){
                $datos = Cliente::where('cedula', $cedula)->first();
                return $datos;
            }

    
}
