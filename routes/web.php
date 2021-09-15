<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
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

Route::get('/{page?}', [PageController::class, 'index'])
    ->where(array('page' => '[0-9]+'))
    ->name('page');

Route::get('/admin/activity/{page?}', [AdminController::class, 'index'])
    ->where(array('page' => '[0-9]+'))
    ->name('admin.activity');
