<?php

use App\Http\Controllers\ComplaintReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestigatorController;
use App\Http\Controllers\OffenderController;
use App\Http\Controllers\OffensesController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\VictimController;
use App\Models\ComplaintReport;
use App\Models\Offender;
use App\Models\Offense;
use App\Models\SuperAdmin;
use App\Models\Victim;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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
})->name('index');

Route::get('/login', [HomeController::class, 'login_view'])->name('login_form');
Route::post('/login_account', [HomeController::class, 'login'])->name('logging_in');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout')->middleware('account');
Route::get('/inactive_screen', [HomeController::class, 'inactive_screen'])->name('inactive_screen');
Route::get('/inactive_screen1', [HomeController::class, 'inactive_screen1'])->name('inactive_screen1');

Route::prefix('investigator')->middleware('account')->group(function(){
    Route::get('/dashboard', [InvestigatorController::class, 'dashboard'])->name('investigator.dashboard');
    Route::get('/filter-dashboard', [InvestigatorController::class, 'filter_dashboard'])->name('superadmin.filter_dashboard');

    Route::get('/complaintreportmanagement', [InvestigatorController::class, 'complaintreportmngt'])->name('investigator.complaintreport');
    Route::get('/complaintreport_form', [InvestigatorController::class, 'complaintreport_form'])->name('investigator.complaintreport_form');

    Route::post('/add_complaint', [ComplaintReportController::class, 'add_complaint1'])->name('investigator.add_complaint');
    Route::get('/adding_complaintreport/{comp_id}', [ComplaintReportController::class, 'adding_complaintreport'])->name('investigator.adding_complaintreport');
    Route::get('/view_complaintreport/{comp_id}', [ComplaintReportController::class, 'view_complaintreport'])->name('investigator.view_complaintreport');
    Route::get('/complaintreport_form/{comp_id}', [ComplaintReportController::class, 'edit_complaintreport'])->name('investigator.edit_complaintreport');
    Route::post('/update_form/{comp_id}', [ComplaintReportController::class, 'update_form'])->name('investigator.update_form');
    Route::get('/delete_form/{comp_id}', [ComplaintReportController::class, 'delete_form'])->name('investigator.delete_form');

    Route::get('/complaintreport_pdf/{comp_id}', [PDFController::class, 'complaint_pdf'])->name('investigator.complaint_pdf');
    Route::get('/readonly_complaintreport/{comp_id}', [ComplaintReportController::class, 'readonly_complaintreport'])->name('investigator.readonly_complaintreport');
    Route::get('/filter-complaintreps', [InvestigatorController::class, 'filter_complaintreps'])->name('investigator.filter_complaintreps');
    Route::post('/change_case_status/{id}', [InvestigatorController::class, 'change_case_status'])->name('investigator.change_case_status');

    Route::get('/victim_form/{comp_id}', [VictimController::class, 'victim_form'])->name('investigator.victim_form');
    Route::post('/insert_victim/{comp_id}', [VictimController::class, 'insert_victim'])->name('investigator.insert_victim');

    Route::get('/offender_form/{comp_id}', [OffenderController::class, 'offender_form'])->name('investigator.offender_form');
    Route::post('/insert_offender/{comp_id}', [OffenderController::class, 'insert_offender'])->name('investigator.insert_offender');

    Route::get('/offensesmanagement', [InvestigatorController::class, 'offensesmngt'])->name('investigator.offensesmanagement');
    Route::get('/delete_offense/{id}', [OffensesController::class, 'delete'])->name('investigator.delete_offense');

    Route::post('/add_offense', [OffensesController::class, 'add'])->name('investigator.add_offense');
    Route::post('/edit_offense', [OffensesController::class, 'update'])->name('investigator.edit_offense');

    Route::get('/victims_management', [InvestigatorController::class, 'victimsmngt'])->name('investigator.victims_mngt');
    Route::get('/filter-victimsmngt', [InvestigatorController::class, 'filter_victimsmngt'])->name('investigator.filter_victimsmngt');
    Route::get('/offenders_management', [InvestigatorController::class, 'suspectsmngt'])->name('investigator.suspects_mngt');
    Route::get('/filter-offendersmngt', [InvestigatorController::class, 'filter_offendersmngt'])->name('investigator.filter_offendersmngt');

    Route::get('/victim_profile/{vid}', [InvestigatorController::class, 'victim_profile'])->name('investigator.victim_profile');
    Route::get('/edit_victim/{vid}', [VictimController::class, 'edit_victim'])->name('investigator.edit_victim');
    Route::post('/update_victim/{vid}', [VictimController::class, 'update_victim'])->name('investigator.update_victim');

    Route::get('/offender_profile/{oid}', [InvestigatorController::class, 'offender_profile'])->name('investigator.offender_profile');
    Route::get('/edit_offender/{oid}', [OffenderController::class, 'edit_offender'])->name('investigator.edit_offender');
    Route::post('/update_offender/{oid}', [OffenderController::class, 'update_offender'])->name('investigator.update_offender');

    Route::get('/allrecords', [InvestigatorController::class, 'allrecords'])->name('investigator.allrecords');
    Route::get('/filter-allrecords', [InvestigatorController::class, 'filter_allrecords'])->name('investigator.filter_allrecords');

    Route::get('/accountmngt', [InvestigatorController::class, 'accountmngt'])->name('investigator.accountmngt');

    Route::get('/change_password_request', [InvestigatorController::class, 'change_passw_request'])->name('investigator.change_password_request');
    Route::get('/change_password', [InvestigatorController::class, 'change_password'])->name('investigator.change_password');
    Route::post('/changing_password', [InvestigatorController::class, 'changing_password'])->name('investigator.changing_password');

    Route::get('/logs', [InvestigatorController::class, 'logs'])->name('investigator.logs');
    Route::get('/filter-logs-inv', [InvestigatorController::class, 'filter_logs'])->name('investigator.filter_logs');

    Route::get('/trash', [InvestigatorController::class, 'trash'])->name('investigator.trash');
    Route::get('/filter-trash', [SuperAdminController::class, 'filter_trash'])->name('superadmin.filter_trash');
    Route::get('/restore_form/{comp_id}', [ComplaintReportController::class, 'restore_form'])->name('investigator.restore_form');
    Route::get('/permanent_del/{comp_id}', [ComplaintReportController::class, 'permanent_del'])->name('investigator.permanent_del');

    Route::get('/testing', [InvestigatorController::class, 'testing'])->name('investigator.testing');
    Route::post('/store', [InvestigatorController::class, 'store'])->name('investigator.store');
    Route::get('/testing1', [InvestigatorController::class, 'index']);
    Route::post('/submit', [InvestigatorController::class, 'submit'])->name('submit');
  
});
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

Route::prefix('superadmin')->middleware('account')->group(function(){
    Route::post('/add_teamaccount', [SuperAdminController::class, 'add_superadmin'])->name('superadmin.add_teamaccount');
    Route::get('/add_investigator_acc', [SuperAdminController::class, 'add_investigator_acc'])->name('superadmin.add_investigator_acc');
    Route::post('/add_investigator', [SuperAdminController::class, 'add_investigator'])->name('superadmin.add_investigator');

    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard')->middleware('account');
    Route::get('/filter-dashboard', [SuperAdminController::class, 'filter_dashboard'])->name('superadmin.filter_dashboard');

    Route::get('/inv_accountmngt', [SuperAdminController::class, 'inv_account_management'])->name('superadmin.inv_account_mngt');
    Route::get('/edit_investigator_acc/{id}', [SuperAdminController::class, 'edit_investigator_acc'])->name('superadmin.edit_investigator_acc');
    Route::post('/edit_investigator_details/{id}', [SuperAdminController::class, 'edit_investigator_details'])->name('superadmin.edit_investigator_details');
    Route::get('/superadmin_accountmngt/{id}', [SuperAdminController::class, 'superadmin_account_management'])->name('superadmin.superadmin_account_mngt');
    Route::post('/change_team/{accid}', [SuperAdminController::class, 'change_team'])->name('superadmin.change_team');
    Route::post('/change_status/{accid}', [SuperAdminController::class, 'change_status'])->name('superadmin.change_status');

    Route::get('/change_password', [SuperAdminController::class, 'change_password'])->name('superadmin.change_password');
    Route::post('/changing_password', [SuperAdminController::class, 'changing_password'])->name('superadmin.changing_password');

    Route::get('/victims_management', [SuperAdminController::class, 'victimsmngt'])->name('superadmin.victims_mngt');
    Route::get('/filter-victimsmngt', [SuperAdminController::class, 'filter_victimsmngt'])->name('superadmin.filter_victimsmngt');

    Route::get('/offenders_management', [SuperAdminController::class, 'suspectsmngt'])->name('superadmin.suspects_mngt');
    Route::get('/filter-offendersmngt', [SuperAdminController::class, 'filter_offendersmngt'])->name('superadmin.filter_offendersmngt');

    Route::get('/victim_profile/{vid}', [SuperAdminController::class, 'victim_profile'])->name('superadmin.victim_profile');
    Route::get('/edit_victim/{vid}', [VictimController::class, 'edit_victim'])->name('superadmin.edit_victim');
    Route::post('/update_victim/{vid}', [VictimController::class, 'update_victim'])->name('superadmin.update_victim');

    Route::get('/offender_profile/{id}', [SuperAdminController::class, 'offender_profile'])->name('superadmin.offender_profile');
    Route::get('/edit_offender/{oid}', [OffenderController::class, 'edit_offender'])->name('superadmin.edit_offender');
    Route::post('/update_offender/{oid}', [OffenderController::class, 'update_offender'])->name('superadmin.update_offender');

    Route::get('/complaintreportmanagement', [SuperAdminController::class, 'complaintreportmngt'])->name('superadmin.complaintreport');
    Route::get('/complaintreport_form', [SuperAdminController::class, 'complaintreport_form'])->name('superadmin.complaintreport_form');
    Route::post('/add_complaint', [ComplaintReportController::class, 'add_complaint1'])->name('superadmin.add_complaint');
    Route::get('/adding_complaintreport/{comp_id}', [ComplaintReportController::class, 'adding_complaintreport'])->name('superadmin.adding_complaintreport');
    Route::get('/view_complaintreport/{comp_id}', [ComplaintReportController::class, 'view_complaintreport'])->name('superadmin.view_complaintreport');
    Route::get('/readonly_complaintreport/{comp_id}', [ComplaintReportController::class, 'readonly_complaintreport'])->name('superadmin.readonly_complaintreport');
    Route::get('/complaintreport_form/{comp_id}', [ComplaintReportController::class, 'edit_complaintreport'])->name('superadmin.edit_complaintreport');
    Route::post('/update_form/{comp_id}', [ComplaintReportController::class, 'update_form'])->name('superadmin.update_form');
    Route::get('/delete_form/{comp_id}', [ComplaintReportController::class, 'delete_form'])->name('superadmin.delete_form');
    Route::get('/complaintreport_pdf/{comp_id}', [PDFController::class, 'complaint_pdf'])->name('superadmin.complaint_pdf');
    Route::post('/change_case_status/{id}', [SuperAdminController::class, 'change_case_status'])->name('superadmin.change_case_status');

    Route::get('/victim_form/{comp_id}', [VictimController::class, 'victim_form'])->name('superadmin.victim_form');
    Route::post('/insert_victim/{comp_id}', [VictimController::class, 'insert_victim'])->name('superadmin.insert_victim');

    Route::get('/offender_form/{comp_id}', [OffenderController::class, 'offender_form'])->name('superadmin.offender_form');
    Route::post('/insert_offender/{comp_id}', [OffenderController::class, 'insert_offender'])->name('superadmin.insert_offender');

    Route::get('/allrecords', [SuperAdminController::class, 'allrecords'])->name('superadmin.allrecords')->middleware('account');
    Route::get('/filter-allrecords', [SuperAdminController::class, 'filter_allrecords'])->name('superadmin.filter_allrecords');
    Route::get('/filter-compsmngt', [SuperAdminController::class, 'filter_compsmngt'])->name('superadmin.filter_compsmngt');

    Route::get('/offensesmanagement', [SuperAdminController::class, 'offensesmngt'])->name('superadmin.offensesmanagement');
    Route::post('/add_offense', [OffensesController::class, 'add'])->name('superadmin.add_offense');
    Route::post('/edit_offense', [OffensesController::class, 'update'])->name('superadmin.edit_offense');
    Route::get('/delete_offense/{id}', [OffensesController::class, 'delete'])->name('superadmin.delete_offense');

    Route::get('/edit_superadmin_acc/{id}', [SuperAdminController::class, 'edit_superadmin_acc'])->name('superadmin.edit_superadmin_acc');
    Route::post('/edit_superadmin_details/{id}', [SuperAdminController::class, 'edit_superadmin_details'])->name('superadmin.edit_superadmin_details');

    Route::get('/password_requests', [SuperAdminController::class, 'password_requests'])->name('superadmin.password_requests');
    Route::get('/inv_changepass_req/{nid}/{id}', [SuperAdminController::class, 'inv_changepass_req'])->name('superadmin.inv_changepass_req');
    Route::post('/inv_changepass_req_post/{nid}/{id}', [SuperAdminController::class, 'inv_changepass_req_post'])->name('superadmin.inv_changepass_req_post');

    Route::get('/logs', [SuperAdminController::class, 'logs'])->name('superadmin.logs');
    Route::get('/filter-logs', [SuperAdminController::class, 'filter_logs'])->name('superadmin.filter_logs');

    Route::get('/trash', [SuperAdminController::class, 'trash'])->name('superadmin.trash');
    Route::get('/filter-trash', [SuperAdminController::class, 'filter_trash'])->name('superadmin.filter_trash');
    Route::get('/restore_form/{comp_id}', [ComplaintReportController::class, 'restore_form'])->name('investigator.restore_form');
    Route::get('/permanent_del/{comp_id}', [ComplaintReportController::class, 'permanent_del'])->name('investigator.permanent_del');
});
