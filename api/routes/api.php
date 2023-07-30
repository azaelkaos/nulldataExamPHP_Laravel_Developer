<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillController;

Route::post('empleado/create',[UserController::class,'create']);
Route::get('empleado/read',[UserController::class,'read']);
Route::get('empleado/list',[UserController::class,'list']);
Route::post('empleado/setAddress',[UserController::class,'setAddress']);
Route::put('skill/update',[SkillController::class,'update']);
Route::post('skill/create',[SkillController::class,'create']);

