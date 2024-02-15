<?php

use App\Http\Controllers\ComplaintReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will be assigned
| to the "web" middleware group, which includes middleware like
| web. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/team/login', function () {
    return view('index');
});


Route::prefix('team')->group(function(){
    Route::get('/login', [HomeController::class, 'login_view'])->name('login_form');
    Route::post('/login_account', [HomeController::class, 'login'])->name('logging_in');
    Route::get('/logout', [HomeController::class, 'logout'])->name('team.logout');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('team.dashboard');
    Route::get('/complaintreportmanagement', [HomeController::class, 'complaintreportmngt'])->name('team.complaintreport');
    Route::get('/complaintreport_form', [HomeController::class, 'complaintreport_form'])->name('team.complaintreport_form');

    Route::post('/add_complaint', [ComplaintReportController::class, 'add_complaint'])->name('team.add_complaint');
    Route::get('/view_complaintreport/{comp_id}', [ComplaintReportController::class, 'view_complaintreport'])->name('team.view_complaintreport');
    Route::get('/edit_complaintreport/{comp_id}', [ComplaintReportController::class, 'edit_complaintreport'])->name('team.edit_complaintreport');
    Route::post('/update_form/{comp_id}', [ComplaintReportController::class, 'update_form'])->name('team.update_form');
    Route::get('/delete_form/{comp_id}', [ComplaintReportController::class, 'delete_form'])->name('team.delete_form');

    Route::get('/complaintreport_pdf/{comp_id}', [PDFController::class, 'complaint_pdf'])->name('team.complaint_pdf');

    Route::get('/offensesmanagement', [HomeController::class, 'offensesmngt'])->name('team.offensesmanagement');

    Route::get('/testing', [HomeController::class, 'testing'])->name('team.testing');
    Route::post('/store', [HomeController::class, 'store'])->name('team.store');
    Route::get('/testing1', [HomeController::class, 'index']);
Route::post('/submit', [HomeController::class, 'submit'])->name('submit');
});

Route::prefix('superadmin')->group(function(){
    Route::post('/add_teamaccount', [SuperAdminController::class, 'add'])->name('superadmin.add_teamaccount');
});
