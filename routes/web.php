<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
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
Route::get('member/booking/{jemput?}', [HomeController::class, 'booking'])->name('member.booking')->middleware('auth');
Route::get('member/booking-paket/{service?}', [HomeController::class, 'paket'])->name('member.goto-paket')->middleware('auth');
Route::get('member/booking-tanggal', [HomeController::class, 'tanggal'])->name('member.goto-tanggal')->middleware('auth');
Route::get('member/booking-waktu', [HomeController::class, 'waktu'])->name('member.goto-waktu')->middleware('auth');
Route::get('member/booking-form', [HomeController::class, 'form'])->name('member.goto-form')->middleware('auth');
Route::post('member/booking-store', [HomeController::class, 'storeBooking'])->name('member.store-booking')->middleware('auth');
Route::get('member/booking-reschedule/{id}', [DashboardController::class, 'reschedule']);
Route::post('member/booking-update/{id}', [DashboardController::class, 'updateBooking'])->name('member.update-booking');
/** END Member Route */

/** Admin Route */
Route::get('admin/dashboard',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/booking-list',[DashboardController::class, 'bookingList'])->name('admin.booking-list');
Route::get('admin/work-order-form/{id}',[DashboardController::class, 'workOrderForm'])->name('admin.work-order-form');
Route::get('admin/work-order',[DashboardController::class, 'workOrder'])->name('admin.work-order');
Route::post('admin/work-order-store/{id}',[DashboardController::class, 'workOrderStore'])->name('admin.work-order-store');
Route::get('admin/work-order-finishing/{id}',[DashboardController::class, 'workOrderfinishing'])->name('admin.work-order-finishing');
Route::get('admin/work-finished',[DashboardController::class, 'workFinished'])->name('admin.work-finished');
Route::get('admin/employee',[DashboardController::class, 'employee'])->name('admin.employee');
Route::post('admin/employee-store',[DashboardController::class, 'employeeStore'])->name('admin.employee-store');
Route::post('admin/employee-store-at-wo-page',[DashboardController::class, 'employeeStoreAtWoPage'])->name('admin.employee-store-at-wo-page');
Route::post('admin/employee-update/{id}',[DashboardController::class, 'employeeUpdate'])->name('admin.employee-update');
Route::get('admin/booking-all',[DashboardController::class, 'showBookingAll'])->name('admin.booking-all');
Route::get('admin/booking-service',[DashboardController::class, 'showBookingService'])->name('admin.booking-service');
Route::get('admin/booking-repair',[DashboardController::class, 'showBookingRepair'])->name('admin.booking-repair');
Route::get('admin/report/{type}',[DashboardController::class, 'showReport'])->name('admin.report');
Route::post('admin/report-search/{type}',[DashboardController::class, 'reportSearch'])->name('admin.report-search');
Route::post('admin/change-estimation/{id}',[DashboardController::class, 'changeEstimation'])->name('admin.change-estimation');
/** END Admin Route */

/** PRINT */
Route::get('print/{id}',[PDFController::class, 'printNota'])->name('admin.print-nota');
Route::get('print-report/{start}/{end}/{service}/{status}',[PDFController::class, 'printReport'])->name('admin.print-report');
/** END PRINT */