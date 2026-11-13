<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FaceBlurController;

Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'submitForm'])->name('register.submit');

Route::get('/', [FaceBlurController::class, 'index'])->name('face-blur.index');
Route::post('/detect-faces', [FaceBlurController::class, 'detect'])->name('face-blur.detect');