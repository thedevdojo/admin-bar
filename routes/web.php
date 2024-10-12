<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::view('admin-bar', 'admin-bar::home')->name('admin-bar');
    Route::get('admin-bar/component', \Wave\Plugins\AdminBar\Components\AdminBar::class)->name('admin-bar.component');
});