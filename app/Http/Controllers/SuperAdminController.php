<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ComplaintReport;
use App\Models\Offense;
use App\Models\SuperAdmin;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function add_superadmin(Request $request){ 
        // $team = new Team(); 
        // $team->username = $request->input('username');
        // $team->password = Hash::make($request->password);
        // $team->save();
        // return redirect()->back()->with('message', 'The record has been added successfully!');

        // $team = new SuperAdmin(); 
        // $team->username = $request->input('username');
        // $team->password = Hash::make($request->password);
        // $team->save();
        // return redirect()->back()->with('message', 'The record has been added successfully!');

        $user = Account::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
            'acc_type' => 'superadmin',
            'team' => 'superadmin',
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message', 'The record has been added successfully!');
    }

    public function add_investigator(Request $request){  
        $user = Account::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
            'acc_type' => 'investigator',
            'team' => $request->input('team'),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message', 'The record has been added successfully!');
    } 

    public function dashboard()
    {
        return view('superadmin.superadmin_dashboard');
    }

    public function inv_account_management()
    {
        $invs = Account::where('acc_type', '=', 'investigator')
            ->get();
        return view('superadmin.superadmin_invaccountmngt', ['invs'=>$invs]);
    }

    public function superadmin_account_management($id)
    {
        $invs = Account::where('id', '=', $id)
            ->get();
        return view('superadmin.superadmin_superadminaccmngt', ['invs'=>$invs]);
    }
 
    public function change_team(Request $request, $accid)
    {
        Account::where('id', $accid)
            ->update([
                'team' => $request->input('team'), 
            ]);
        return redirect()->back()->with('message', 'Account"s team has been added successfully!');
    }

    public function change_status(Request $request, $accid)
    {
        Account::where('id', $accid)
            ->update([
                'status' => $request->input('status'), 
            ]);
        return redirect()->back()->with('message', 'Account"s team has been added successfully!');
    }

    public function change_password()
    {
        $id = Auth::guard('account')->user()->id;
        $invs = Account::where('id', '=', $id)
            ->get();
        return view('superadmin.superadmin_changepassword', ['invs'=>$invs]);
    }

    public function changing_password(Request $request)
    { 
        $id = Auth::guard('account')->user()->id;
        $username = $request->input('username');
        $invs = Account::where('id', '=', $id)
            ->first();
        $check = $request->all();

        // with('error', 'Admin account logged in successfully!');
        if (Auth::guard('account')->attempt(['username' => $check['username'], 'password' => $check['curr_password']])){
            if(Auth::guard('account')->check()){
                // dd('goods');
                Account::where('id', $id)
                ->update([
                    'password' => Hash::make($request->new_password),
                ]);
                dd('napalitan');
            }
        }
        else{
            return redirect()->back()->with('error', 'The username or current password you entered is incorrect.');
        }
    }

    public function victimsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('complaint_reports.id', 'DESC') 
            ->get();
        return view('superadmin.superadmin_victimsmngt', ['comps'=>$comps]);
    }

    public function victim_profile($id)
    { 
        $comps = ComplaintReport::  
            where('id', '=', $id)
            ->get();
        return view('superadmin.superadmin_viewvictimprofile', ['comps'=>$comps]);
    }

    public function suspectsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('complaint_reports.id', 'DESC') 
            ->get();
        return view('superadmin.superadmin_suspectsmngt', ['comps'=>$comps]);
    }

    public function offender_profile($id)
    { 
        $comps = ComplaintReport::  
            where('id', '=', $id)
            ->get();
        return view('superadmin.superadmin_viewoffenderprofile', ['comps'=>$comps]);
    }
        
    public function complaintreportmngt()
    {
        // $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        // ->where('complaint_report_author', $author_id)
        ->where('complaint_reports.status', 'notdeleted')
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        return view('superadmin.superadmin_complaintreportmngt', ['comps'=>$comps]);
    }

    public function allrecords()
    {
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', 'notdeleted') 
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        return view('superadmin.superadmin_allrecords', ['comps' => $comps]);
    }

    public function offensesmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $offenses = Offense::select('*') 
        ->where('not_delete', '=', false)
        ->get();
        return view('investigator.investigator_offensesmngt', ['offenses'=>$offenses]);
    } 

    public function filter_allrecords(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_reports.status', 'notdeleted') 
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        return view('superadmin.superadmin_allrecords', ['comps' => $comps]);
    }

    public function filter_compsmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));
         
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        // ->where('complaint_report_author', $author_id)
        ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_reports.status', 'notdeleted')
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        return view('superadmin.superadmin_complaintreportmngt', ['comps'=>$comps]);
    }
} 
