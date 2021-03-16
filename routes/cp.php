<?php

	use DDM\CookieByte\CookieByte;
	use DDM\CookieByte\Http\Controllers\SettingsController;
	use Illuminate\Support\Facades\Route;

	Route::prefix(CookieByte::NAMESPACE . '/')->name(CookieByte::NAMESPACE . '.')->group(function () {
		Route::name('settings.')->group(function () {
			Route::get('/', [SettingsController::class, 'index'])->name('index');
			Route::post('/', [SettingsController::class, 'update'])->name('update');
		});
	});