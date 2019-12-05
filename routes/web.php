<?php

Route::get('/','ImageController@index')->name('dropzone.index');
Route::post('/store','ImageController@store')->name('dropzone.store');
Route::post('/destroy','ImageController@destroy')->name('dropzone.destroy');

Route::get('files', function() {
    return Illuminate\Support\Facades\Storage::allFiles('public/images/');
});
