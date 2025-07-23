<?php

use App\Http\Controllers\Admins\ClientesController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\ReporteController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('Sistema')->group(function () {

        // Actualizar Perfil
        Route::controller(ProfileController::class)->middleware('can:perfil')->group(function () {
            Route::get('Perfil', 'edit')->name('profile.edit');
            Route::patch('Perfil', 'update')->name('profile.update');
            // Route::delete('Perfil', 'destroy')->name('profile.destroy');
        });

        // Panel principal
        Route::controller(DashboardController::class)->group(function () {
            Route::get('Dashboard', 'index')->name('dashboard');
        });

        // clientes
        Route::controller(ClientesController::class)->middleware('can:clientes')->group(function () {
            Route::get('Clientes', 'index')->name('clientes');
            Route::get('Clientes/Lista', 'lista');
            Route::post('Clientes', 'crear');
            Route::get('Clientes/{id}', 'detalle');
            Route::post('Clientes/Editar/{id}', 'editar');
            Route::delete('Clientes/{id}', 'eliminar');
        });

        // Administradores
        Route::controller(UserController::class)->middleware('can:administradores')->group(function () {
            Route::get('Administradores', 'adminIndex')->name('administradores');
            Route::get('Administradores/Lista', 'adminLista');
            Route::post('Administradores', 'adminCrear');
            Route::get('Administradores/{id}', 'adminDetalle');
            Route::post('Administradores/Editar/{id}', 'adminEditar');
            Route::delete('Administradores/{id}', 'adminEliminar');
        });

        // Vendedores
        Route::controller(UserController::class)->middleware('can:vendedores')->group(function () {
            Route::get('Vendedores', 'vendeIndex')->name('vendedores');
            Route::get('Vendedores/Lista', 'vendeLista');
            Route::post('Vendedores', 'vendeCrear');
            Route::get('Vendedores/{id}', 'vendeDetalle');
            Route::post('Vendedores/Editar/{id}', 'vendeEditar');
            Route::delete('Vendedores/{id}', 'vendeEliminar');
        });
        
    });
});
