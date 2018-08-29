<?php

use Illuminate\Support\Facades\Route;

Route::get('/numberOfRooms', 'MainController@numberOfRoomsAction')->name('numberOfRooms');
Route::get('/numberOfStoreys', 'MainController@numberOfStoreysAction')->name('numberOfStoreys');
Route::get('/level', 'MainController@levelAction')->name('level');
Route::get('/area', 'MainController@areaAction')->name('area');
Route::get('/price', 'MainController@priceAction')->name('price');

Route::get('/{item?}', 'MainController@indexAction');
