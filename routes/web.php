<?php

use App\Models\ToDo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/', [ToDo::class, 'index'])->name('home');
Route::get('todo/create', [ToDo::class, 'create']);
Route::post('todo/store', [ToDo::class, 'store'])->name('todo.store');
Route::get('todo/{todo}/edit', [ToDo::class, 'edit'])->name('todo.edit');
Route::put('todo/{todo}/update', [ToDo::class, 'updateTodo'])->name('todo.update');
