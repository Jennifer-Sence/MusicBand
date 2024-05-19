<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;

//Rotas bandas ---ver isso
Route::get('/', [BandController::class, 'index' ])->name('band.index');
Route::get('/home', [BandController::class, 'index' ])->name('band.index');

Route::get('/bands/create', [BandController::class, 'create'])->name('bands.create')->middleware('auth');
Route::post('/bands/store', [BandController::class, 'store'])->name('bands.store')->middleware('auth');
Route::match(['get', 'post'], '/bands/{id}/edit', [BandController::class, 'editOrUpdate'])->name('bands.editOrUpdate')->middleware('auth');
Route::get('/delete-bands/{id}', [BandController::class, 'deleteBand'])->name('bands.delete')->middleware('auth');


//Rotas albuns
Route::get('/albums/{band}', [AlbumController::class, 'showAlbums'])->name('albuns.show');
Route::get('/albuns/create/{band}', [AlbumController::class, 'createAlbum'])->name('albuns.create')->middleware('auth');
Route::post('/albuns/store', [AlbumController::class, 'storeAlbum'])->name('albuns.store')->middleware('auth');
Route::get('/delete-albuns/{id}', [AlbumController::class, 'deleteAlbum'])->name('albuns.delete')->middleware('auth');
Route::match(['get', 'post'], '/albuns/{id}/edit', [AlbumController::class, 'editOrUpdate'])->name('albuns.editOrUpdate')->middleware('auth');


//Rotas users
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
