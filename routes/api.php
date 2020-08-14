<?php
Route::resource('real-estates', 'RealEstateController');
Route::patch('real-estates/{id}/mark-as-published', 'RealEstateController@markAsPublished')
    ->name('real-estates.mark-as-published');
Route::patch('real-estates/{id}/mark-as-drafted', 'RealEstateController@markAsDrafted')
    ->name('real-estates.mark-as-drafted');
Route::patch('real-estates/{id}/mark-as-pending', 'RealEstateController@markAsPending')
    ->name('real-estates.mark-as-pending');

Route::get('services/search-by-name/{name}', 'ServiceController@searchByName')
    ->name('services.search');
Route::resource('services', 'ServiceController');

Route::prefix('units')->group(function () {
    Route::get('sizes','UnitController@size');
    Route::get('durations','UnitController@duration');
    Route::get('currencies','UnitController@currency');
});
