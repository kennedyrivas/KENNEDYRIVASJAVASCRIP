<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Service\Admins\ClienteClass;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;


class ClientesController extends Controller
{
    private $clienteClass;

    public function __construct(ClienteClass $clienteClass)
    {
        $this->clienteClass = $clienteClass;
    }

    public function index(): view
    {
        return view('software.pages.clientes');
    }

    public function lista()
    {
        $datos = $this->clienteClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function detalle(Cliente $id): JsonResponse
    {
        return response()->json($id);
    }

    public function crear(ClienteRequest $datos): JsonResponse
    {
        try {
            $this->clienteClass->crear($datos);
            $repuesta = response()->json([
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => true
            ], 422);
        }
        return $repuesta;
    }

    public function editar(ClienteRequest $datos, Cliente $id): JsonResponse
    {
        try {
            $this->clienteClass->editar($datos, $id);
            $repuesta = response()->json([
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => true
            ], 422);
        }
        return $repuesta;
    }

    public function eliminar(Cliente $id)
    {
        try {
            $id->delete();
            $respuesta = response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true], 404);
        }
        return $respuesta;
    }
}
