<?php

Route::patch('operadoras/toggle', 'API\OperadoraController@toggle');
Route::patch('operadoras/delete', 'API\OperadoraController@destroy');

Route::get('operadoras_search', 'API\OperadoraController@search');
Route::resource('operadoras', 'API\OperadoraController');






