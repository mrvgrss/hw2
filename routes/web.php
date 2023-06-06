<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('register', 'App\Http\Controllers\LoginController@register_form');
Route::get('login', 'App\Http\Controllers\LoginController@login_form');
Route::get('reviews/{max}', 'App\Http\Controllers\ReviewController@reviews_list');
Route::post('review', 'App\Http\Controllers\ReviewController@createUpdateReview');
Route::get('favourite', 'App\Http\Controllers\FavouriteController@favourite_list');
Route::post('register', 'App\Http\Controllers\LoginController@do_register');
Route::post('login', 'App\Http\Controllers\LoginController@do_login');
Route::get('logout', 'App\Http\Controllers\LoginController@do_logout');
Route::get('home', 'App\Http\Controllers\HomeController@home');
Route::get('flight/{origin}/{destination}/{departureDate}/{returnDate}/{adults}', 'App\Http\Controllers\BookingController@searchFlight');
Route::get('preBookFlight/{offerId}', 'App\Http\Controllers\BookingController@preBookFlight');
Route::get('bookFlight/{offerId}', 'App\Http\Controllers\BookingController@bookFlight');
Route::get('mybookings', 'App\Http\Controllers\BookingController@mybookings');
Route::get('listofbookings', 'App\Http\Controllers\BookingController@listBookings');
Route::get('profile', 'App\Http\Controllers\ProfileController@profile');

// debug
// Route::get('searchterm/{term}', 'App\Http\Controllers\BookingController@checkCode');