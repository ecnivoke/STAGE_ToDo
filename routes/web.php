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
<<<<<<< HEAD
<<<<<<< Updated upstream
=======
=======
>>>>>>> Stashed changes

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/lists/add', [ListsController::class, 'store'])->name('add_list');
Route::post('/tasks/add', [TasksController::class, 'store'])->name('add_task');

require __DIR__.'/auth.php';
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
>>>>>>> c95f3f096846d47deb4b53fd78e86009e32ac77c
=======
>>>>>>> Stashed changes
