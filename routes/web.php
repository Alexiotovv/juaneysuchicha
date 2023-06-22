<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VisitasController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VisitascontadorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('usuarios.login');
});



Route::get('/login',function(){
    return view('usuarios.login');
})->name('login')->middleware('guest');

Route::get('/home',function(){
    return view('plantillas.home');
})->middleware('auth')->name('home');

//Visitas
Route::get('/visitas/create', [VisitasController::class,'create'])->middleware(['auth'])->name('visitas.create');
Route::post('/visitas/store', [VisitasController::class,'store'])->middleware(['auth'])->name('visitas.store');
Route::get('/visitas/consultas', [VisitasController::class,'consultas'])->middleware(['auth'])->name('visitas.consultas');

//Visitas Contador
Route::get('/visitascontador/create', [VisitascontadorController::class,'create'])->middleware(['auth'])->name('visitascontador.create');
Route::post('/visitascontador/store', [VisitascontadorController::class,'store'])->middleware(['auth'])->name('visitascontador.store');

//Ventas
Route::get('/ventas/create', [VentasController::class,'create'])->middleware(['auth'])->name('ventas.create');
Route::post('/ventas/store', [VentasController::class,'store'])->middleware(['auth'])->name('ventas.store');

//productos
Route::post('/productos/store', [ProductosController::class,'store'])->middleware(['auth'])->name('productos.store');
Route::get('/productos/show', [ProductosController::class,'show'])->middleware(['auth'])->name('productos.show');

//Usuarios
Route::get('/usuarios/index', [UserController::class,'index'])->middleware(['auth'])->name('usuarios.index');
Route::get('/usuarios/edit/{id}', [UserController::class,'edit'])->middleware(['auth'])->name('usuarios.edit');
Route::post('/usuarios/update', [UserController::class,'update'])->middleware(['auth'])->name('usuarios.update');
Route::get('/usuarios/create', [UserController::class,'create'])->middleware(['auth'])->name('usuarios.create');
Route::post('/usuarios/store', [UserController::class,'store'])->middleware(['auth'])->name('usuarios.store');

Route::get("/verificanombre/{name}",[UserController::class,'verificanombre'])->middleware(['auth'])->name('verificanombre');
Route::get("/verificaemail/{email}",[UserController::class,'verificaemail'])->middleware(['auth'])->name('verificaemail');
Route::post("/ActualizaContrasena",[UserController::class, "ActualizaContrasena"])->middleware(['auth'])->name('Actualiza.Contrasena');

Route::post("/login",[LoginController::class, 'login']);
Route::put('/login', [LoginController::class, 'logout']);