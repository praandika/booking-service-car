<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'googleCallback'])->name('google.callback');

/** Member Route */
Route::get('member', [DashboardController::class, 'member'])->name('member');
Route::get('member/booking-list', [DashboardController::class, 'memberBookingList'])->name('member.booking-list');
Route::get('member/history', [DashboardController::class, 'memberHistory'])->name('member.history');
Route::get('member/booking', [HomeController::class, 'booking'])->name('member.booking')->middleware('auth');
Route::get('member/booking-tanggal', [HomeController::class, 'tanggal'])->name('member.goto-tanggal')->middleware('auth');
Route::get('member/booking-waktu', [HomeController::class, 'waktu'])->name('member.goto-waktu')->middleware('auth');
Route::get('member/booking-form', [HomeController::class, 'form'])->name('member.goto-form')->middleware('auth');
Route::post('member/booking-store', [HomeController::class, 'storeBooking'])->name('member.store-booking')->middleware('auth');
/** END Member Route */

/** Admin Route */
Route::get('dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');
/** END Admin Route */