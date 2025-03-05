<?php

use App\Http\Controllers\Admin\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Admin\TopController as AdminTopController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;

/** user screen */
Route::get('/', [TopController::class, 'index'])->name('top');
Route::get('/{prefecture_name_alpha}/hotellist', [HotelController::class, 'showList'])->name('hotelList');
Route::get('/hotel/{hotel_id}', [HotelController::class, 'showDetail'])->name('hotelDetail');

/** admin screen */
Route::get('/admin', [AdminTopController::class, 'index'])->name('adminTop');
Route::get('/admin/hotel/search', [AdminHotelController::class, 'showSearch'])->name('adminHotelSearchPage');
Route::get('/admin/hotel/edit/{hotel_id}', [AdminHotelController::class, 'showEdit'])->name('adminHotelEditPage');
Route::get('/admin/hotel/create', [AdminHotelController::class, 'showCreate'])->name('adminHotelCreatePage');
Route::get('/admin/hotel/search/result', [AdminHotelController::class, 'searchResult'])->name('adminHotelSearchResult');
Route::post('/admin/hotel/edit/{hotel_id}', [AdminHotelController::class, 'edit'])->name('adminHotelEditProcess');
Route::post('/admin/hotel/create', [AdminHotelController::class, 'create'])->name('adminHotelCreateProcess');
Route::post('/admin/hotel/delete', [AdminHotelController::class, 'delete'])->name('adminHotelDeleteProcess');
//bookings
Route::get('/admin/bookings/search', [BookingController::class, 'search'])->name('adminBookingSearchPage');
Route::get('/admin/bookings/create', [BookingController::class, 'create'])->name('adminBookingCreatePage');
Route::post('/admin/bookings/store', [BookingController::class, 'store'])->name('adminBookingStore');
