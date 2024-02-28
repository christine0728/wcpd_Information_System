<?php

use App\Http\Controllers\ComplaintReportController;
use App\Http\Controllers\InvestigatorController;
use App\Http\Controllers\OffensesController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SuperAdminController;
use App\Models\Offense;
use App\Models\SuperAdmin;
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

Route::get('/login', [InvestigatorController::class, 'login_view'])->name('login_form');
Route::post('/login_account', [InvestigatorController::class, 'login'])->name('logging_in');
Route::get('/logout', [InvestigatorController::class, 'logout'])->name('logout');

Route::prefix('investigator')->group(function(){
    Route::get('/dashboard', [InvestigatorController::class, 'dashboard'])->name('investigator.dashboard');

    Route::get('/complaintreportmanagement', [InvestigatorController::class, 'complaintreportmngt'])->name('investigator.complaintreport');
    Route::get('/complaintreport_form', [InvestigatorController::class, 'complaintreport_form'])->name('investigator.complaintreport_form'); 
    
    Route::post('/add_complaint', [ComplaintReportController::class, 'add_complaint'])->name('investigator.add_complaint');
    Route::get('/view_complaintreport/{comp_id}', [ComplaintReportController::class, 'view_complaintreport'])->name('investigator.view_complaintreport');
    Route::get('/edit_complaintreport/{comp_id}', [ComplaintReportController::class, 'edit_complaintreport'])->name('investigator.edit_complaintreport');
    Route::post('/update_form/{comp_id}', [ComplaintReportController::class, 'update_form'])->name('investigator.update_form');
    Route::get('/delete_form/{comp_id}', [ComplaintReportController::class, 'delete_form'])->name('investigator.delete_form');

    Route::get('/complaintreport_pdf/{comp_id}', [PDFController::class, 'complaint_pdf'])->name('investigator.complaint_pdf');
    Route::get('/readonly_complaintreport/{comp_id}', [ComplaintReportController::class, 'readonly_complaintreport'])->name('investigator.readonly_complaintreport');
    Route::get('/filter-complaintreps', [InvestigatorController::class, 'filter_complaintreps'])->name('investigator.filter_complaintreps');

    Route::get('/offensesmanagement', [InvestigatorController::class, 'offensesmngt'])->name('investigator.offensesmanagement');
    Route::get('/delete_offense/{id}', [OffensesController::class, 'delete'])->name('investigator.delete_offense');

    Route::post('/add_offense', [OffensesController::class, 'add'])->name('investigator.add_offense');
    Route::post('/edit_offense', [OffensesController::class, 'update'])->name('investigator.edit_offense');

    Route::get('/victims_management', [InvestigatorController::class, 'victimsmngt'])->name('investigator.victims_mngt');
    Route::get('/filter-victimsmngt', [InvestigatorController::class, 'filter_victimsmngt'])->name('investigator.filter_victimsmngt');
    Route::get('/suspects_management', [InvestigatorController::class, 'suspectsmngt'])->name('investigator.suspects_mngt');
    Route::get('/filter-offendersmngt', [InvestigatorController::class, 'filter_offendersmngt'])->name('investigator.filter_offendersmngt');

    Route::get('/victim_profile/{id}', [InvestigatorController::class, 'victim_profile'])->name('investigator.victim_profile');
    Route::get('/offender_profile/{id}', [InvestigatorController::class, 'offender_profile'])->name('investigator.offender_profile');

    Route::get('/allrecords', [InvestigatorController::class, 'allrecords'])->name('investigator.allrecords');
    Route::get('/filter-allrecords', [InvestigatorController::class, 'filter_allrecords'])->name('investigator.filter_allrecords');
    

    Route::get('/accountmngt', [InvestigatorController::class, 'accountmngt'])->name('investigator.accountmngt');

    Route::get('/change_password_request', [InvestigatorController::class, 'change_passw_request'])->name('investigator.change_password_request');


    Route::get('/testing', [InvestigatorController::class, 'testing'])->name('investigator.testing');
    Route::post('/store', [InvestigatorController::class, 'store'])->name('investigator.store');
    Route::get('/testing1', [InvestigatorController::class, 'index']);
Route::post('/submit', [InvestigatorController::class, 'submit'])->name('submit');
});

Route::prefix('superadmin')->group(function(){
    Route::post('/add_teamaccount', [SuperAdminController::class, 'add_superadmin'])->name('superadmin.add_teamaccount');
    Route::post('/add_investigator', [SuperAdminController::class, 'add_investigator'])->name('superadmin.add_investigator'); 

    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/inv_accountmngt', [SuperAdminController::class, 'inv_account_management'])->name('superadmin.inv_account_mngt');
    Route::get('/superadmin_accountmngt/{id}', [SuperAdminController::class, 'superadmin_account_management'])->name('superadmin.superadmin_account_mngt');
    Route::post('/change_team/{accid}', [SuperAdminController::class, 'change_team'])->name('superadmin.change_team');
    Route::post('/change_status/{accid}', [SuperAdminController::class, 'change_status'])->name('superadmin.change_status');

    Route::get('/change_password', [SuperAdminController::class, 'change_password'])->name('superadmin.change_password');
    Route::post('/changing_password', [SuperAdminController::class, 'changing_password'])->name('superadmin.changing_password');

    Route::get('/victims_management', [SuperAdminController::class, 'victimsmngt'])->name('superadmin.victims_mngt');
    Route::get('/filter-victimsmngt', [SuperAdminController::class, 'filter_victimsmngt'])->name('superadmin.filter_victimsmngt');

    Route::get('/suspects_management', [SuperAdminController::class, 'suspectsmngt'])->name('superadmin.suspects_mngt');

    Route::get('/victim_profile/{id}', [SuperAdminController::class, 'victim_profile'])->name('superadmin.victim_profile');
    Route::get('/offender_profile/{id}', [SuperAdminController::class, 'offender_profile'])->name('superadmin.offender_profile');

    Route::get('/complaintreportmanagement', [SuperAdminController::class, 'complaintreportmngt'])->name('superadmin.complaintreport');
    Route::get('/complaintreport_form', [SuperAdminController::class, 'complaintreport_form'])->name('superadmin.complaintreport_form'); 
    Route::post('/add_complaint', [ComplaintReportController::class, 'add_complaint'])->name('investigator.add_complaint');
    Route::get('/view_complaintreport/{comp_id}', [ComplaintReportController::class, 'view_complaintreport'])->name('superadmin.view_complaintreport');
    Route::get('/readonly_complaintreport/{comp_id}', [ComplaintReportController::class, 'readonly_complaintreport'])->name('superadmin.readonly_complaintreport');
    Route::get('/edit_complaintreport/{comp_id}', [ComplaintReportController::class, 'edit_complaintreport'])->name('superadmin.edit_complaintreport');
    Route::post('/update_form/{comp_id}', [ComplaintReportController::class, 'update_form'])->name('superadmin.update_form');
    Route::get('/delete_form/{comp_id}', [ComplaintReportController::class, 'delete_form'])->name('superadmin.delete_form');

    Route::get('/allrecords', [SuperAdminController::class, 'allrecords'])->name('superadmin.allrecords');
    Route::get('/filter-allrecords', [SuperAdminController::class, 'filter_allrecords'])->name('investigator.filter_allrecords');
    Route::get('/filter-compsmngt', [SuperAdminController::class, 'filter_compsmngt'])->name('investigator.filter_compsmngt');

    Route::get('/offensesmanagement', [SuperAdminController::class, 'offensesmngt'])->name('superadmin.offensesmanagement');
    Route::post('/add_offense', [OffensesController::class, 'add'])->name('superadmin.add_offense');
    Route::get('/delete_offense/{id}', [OffensesController::class, 'delete'])->name('superadmin.delete_offense');
});
