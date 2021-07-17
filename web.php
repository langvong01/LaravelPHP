<?php

use Illuminate\Support\Facades\Route;

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
    //return 'Welcome to Do Quang Vinh';
    return view('welcome');
});
Route::get('about',function (){
    return "This is information about us";
});
Route::get('about/directions',function (){
    return "Directions go here";
});
Route::any('submit-form',function (){
    return "Process form";
});
Route::get('about/{TheSubject}',function ($TheSubject){
    return $TheSubject . ' is the content here';
});
Route::get('about/{Art}/{Price}',function ($Art,$Price){
    return $Price . ' is the price of '.$Art;
});

