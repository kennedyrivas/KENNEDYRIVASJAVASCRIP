<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAdminRequest;
use App\Http\Requests\UserVendeRequest;
use App\Models\User;
use App\Service\Admins\UserClass;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{

    private $userClass;

    public function __construct(UserClass $userClass)
    {
        $this->userClass = $userClass;
    }

    public function adminIndex(): View
    {
        return view('software.pages.administradores');
    }

    public function adminLista()
    {
        $datos = $this->userClass->adminLista();
        return datatables()->of($datos)->toJson();
    }

    public function vendeIndex(): View
    {
        return view('software.pages.vendedores');
    }

    public function vendeLista()
    {
        $datos = $this->userClass->vendeLista();
        return datatables()->of($datos)->toJson();
    }

    public function adminCrear(UserAdminRequest $datos): JsonResponse
    {
        try {
            ($datos['tipo'] == '1') ? $this->userClass->crear($datos, 'SuperAdmin'): $this->userClass->crear($datos, 'Admin');
            $respuesta = response()->json(['success' => true], 201);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true], 400);
        }
        return $respuesta;
    }

    public function vendeCrear(UserVendeRequest $datos): JsonResponse
    {
        try {
            $this->userClass->crear($datos, 'Vendedor');
            $respuesta = response()->json(['success' => true], 201);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true], 400);
        }
        return $respuesta;
    }

    public function adminDetalle(User $id): JsonResponse
    {
        $repuesta = ($id->tipo == 'SuperAdmin' or $id->tipo == 'Admin') ? response()->json($id): response()->json(['error' => true], 404);
        return $repuesta;
    }

    public function vendeDetalle(User $id): JsonResponse
    {
        $repuesta = ($id->tipo == 'Vendedor') ? response()->json($id): response()->json(['error' => true], 404);
        return $repuesta;
    }

    public function adminEditar(UserAdminRequest $datos, User $id): JsonResponse
    {
        try {
            ($datos->tipo == '1') ?  $this->userClass->editar($datos, 'SuperAdmin', $id) : $this->userClass->editar($datos, 'Admin', $id);
            $respuesta = response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true], 400);
        }
        return $respuesta;
    }

    public function vendeEditar(UserVendeRequest $datos, User $id): JsonResponse
    {
        try {
            $this->userClass->editar($datos, 'Vendedor', $id);
            $respuesta = response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true], 400);
        }
        return $respuesta;
    }

    public function adminEliminar(User $id): JsonResponse
    {
        if($id->tipo == 'SuperAdmin' or $id->tipo == 'Admin'){
            $id->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => true]);
    }

    public function vendeEliminar(User $id): JsonResponse
    {
        if($id->tipo == 'Vendedor'){
            $id->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => true]);
    }

}
