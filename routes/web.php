<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('members/');
});

Route::get('/scan-barcode', function () {
    return view('scan_barcode');
});

Route::get('/scan-qrcode', function () {
    return view('scan_qrcode');
});


// Route::get('import', 'ImportController@index');
// Route::post('import', 'ImportController@import')->name('import');

// Route::get('member', 'MemberController@index');
// Route::get('member/create', 'MemberController@create');
Route::resource('members', 'MembersController');
Route::post('member/import', 'MembersController@import')->name('member-import');
