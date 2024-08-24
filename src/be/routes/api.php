<?php

use App\Http\Controllers\DirectoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('directories')->group(function () {
    Route::get('/root/list', [DirectoryController::class, 'listRoot'])->name('directory.root');
    Route::get('/', [DirectoryController::class, 'list'])->name('directory.list');
    Route::post('/', [DirectoryController::class, 'store'])->name('directory.store');
});
