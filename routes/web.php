<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ToDoController;
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
Route::get('/', [ToDoController::class, 'index'])->name('home');
Route::get('todo/create', [ToDoController::class, 'create'])->name('todo.create');
Route::post('todo/store', [ToDoController::class, 'store'])->name('todo.store');
Route::get('todo/{todo}/edit', [ToDoController::class, 'edit'])->name('todo.edit');
Route::put('todo/{todo}/update', [ToDoController::class, 'updateTodo'])->name('todo.update');
Route::delete('todo/delete', [ToDoController::class, 'deleteTodo'])->name('todo.delete');
Route::post('todos/reorder', [ToDoController::class, 'updateTodoOrder'])->name('todos.reorder');
Route::get('project/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('project/store', [ProjectController::class, 'store'])->name('project.store');
