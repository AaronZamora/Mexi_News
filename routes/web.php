<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;

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

Route::get('/', [apiController::class, 'injectar'])-> name('index');

Route::get('/apiMiguel',[apiController::class, 'jalarMiguel'])-> name('apiMiguel');

Route::get('/apiMarco',[apiController::class, 'jalarMarco'])-> name('apiMarco');