<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('task', controller: TaskController::class);
Route::patch('update_status/{task_id}/', [TaskController::class,'update_status'])->name('update_status');

Route::get('all_trashed_task', [TaskController::class,'all_trashed_tasks'])->name('all_trashed_task');
Route::post('task_restore/{task_id}/', [TaskController::class,'restore'])->name('task.restore');
Route::delete('task_forceDelete/{task_id}/', [TaskController::class,'forceDelete'])->name('task.forceDelete');

Route::get('TaskPending',[TaskController::class , 'Task_Pending'])->name('TaskPending');

