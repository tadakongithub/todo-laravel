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

Route::get('todo/create', [Todo::class, 'create']);
Route::post('todo/store', [Todo::class, 'store'])->name('todo.store');
