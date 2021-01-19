<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TasksController;

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

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/lists/add', [ListsController::class, 'store'])->name('add_list');
Route::post('/tasks/add', [TasksController::class, 'store'])->name('add_task');

require __DIR__.'/auth.php';
>>>>>>> Stashed changes
