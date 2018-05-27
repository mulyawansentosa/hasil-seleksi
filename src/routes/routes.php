<?php

Route::group(['prefix' => 'hasil-seleksi'], function() {
    Route::get('demo', 'Bantenprov\HasilSeleksi\Http\Controllers\HasilSeleksiController@demo');
});
