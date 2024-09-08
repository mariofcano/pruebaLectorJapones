<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalizadorTextoController;

// Ruta que carga la vista del analizador como la página principal
Route::get('/', function () {
    return view('analizador'); // Esta es la vista donde estará el formulario.
});

// Ruta que procesa el análisis del texto
Route::post('/analizar', [AnalizadorTextoController::class, 'analizar'])->name('analizar');
