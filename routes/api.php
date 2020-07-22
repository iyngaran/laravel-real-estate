<?php
Route::resource('real-estates', 'RealEstateController');
Route::resource('services', 'ServiceController');

Route::prefix('units')->group(function () {
    Route::get('sizes','UnitController@size');
    Route::get('durations','UnitController@duration');
    Route::get('currencies','UnitController@currency');
});
