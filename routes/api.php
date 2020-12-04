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
Route::post('upload-image', 'ImageUploadController@upload');
Route::resource('comments', 'CommentController');
Route::get('comments/approved/{realEstatePost}', 'CommentController@approvedComments')
    ->name('comments.approved');
Route::get('comments/all/{realEstatePost}', 'CommentController@allComments')
    ->name('comments.all');

Route::resource('promote-packages', 'PromotePackageController');
Route::get('promote-packages/enabled', 'PromotePackageController@promotePackage')
    ->name('promote-packages.enabled');

Route::prefix('units')->group(function () {
    Route::get('sizes','UnitController@size');
    Route::get('durations','UnitController@duration');
    Route::get('currencies','UnitController@currency');
});
