<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\ClassDetailController;
use App\Http\Controllers\Admin\ClassDetailStudentController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\GenerateAttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',[AuthenticationController::class, 'login']);

Route::group( ['prefix' => '/v1','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
 
    //Authentication Controller
    Route::get('/details',[AuthenticationController::class, 'details']);
    Route::post('/logout',[AuthenticationController::class, 'logout']);
    Route::get('/statistics/{year}',[AuthenticationController::class, 'statistics']);


    // ARTICLES
    Route::get('article/index',[ArticleController::class,'index']);
    Route::get('article/show/{article}',[ArticleController::class, 'show']);
    Route::post('article/create',[ArticleController::class,'create']);
    Route::put('article/update/{article}',[ArticleController::class,'update']);
    Route::put('article/update-voute/{article}/{vote}',[ArticleController::class,'updateVote']);
    Route::delete('article/delete/{article}',[ArticleController::class,'delete']);

 
});