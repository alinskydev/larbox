<?php

use Illuminate\Support\Facades\Route;

use Http\Common\System\Controllers\SystemController;

Route::get('empty', fn () => [])->name('empty');
Route::get('system', [SystemController::class, 'index'])->name('system');
