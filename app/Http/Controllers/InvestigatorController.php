<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ComplaintReport;
use App\Models\Employee;
use App\Models\Offense;
use App\Models\Notification;
use App\Models\Notifications;
use App\Models\Team;
use App\Models\TeamModel;
use App\Notifications\MyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvestigatorController extends Controller
{
    public function login_view()
    {
        return view('login_view');
    }

    public function login(Request $request){ 
        $username = $request->input('username');
        $check = $request->all();

        if(Auth::guard('account')->attempt(['username' => $check['username'], 'password' => $check['password']])){
            if (Auth::guard('account')->check()) {
                $pw = $check['password'];

                $accepted = Account::select('*')->where('username', $username) 
                    ->first();

                $stat = $accepted->acc_type;

                if ($stat == 'superadmin'){
                    // dd('dito superadmin');
                    return redirect()->route('superadmin.dashboard')->with('error', 'investigator account logged in successfully');
                }
                if ($stat == 'investigator'){
                    // dd('dito investigator');
                    return redirect()->route('investigator.dashboard')->with('error', 'investigator account logged in successfully');
                } 
            } else {
                dd('User not authenticated');
            }
        }
        else{
            return back()->with('error', 'The username or password you entered is incorrect.');
        }
    }

    public function logout()
    {
        Auth::guard('account')->logout();
        return redirect()->route('login_form')->with('success', 'Account logged out successfully');
    }

    public function dashboard()
    {
        return view('investigator.investigator_dashboard');
    }

    public function testing()
    {
        return view('investigator.testing');
    }

    public function store(Request $request)
    {
        Employee::create($request->all());
        return back();
    }

    public function complaintreportmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')->where('complaint_report_author', $author_id)
        ->where('complaint_reports.status', 'notdeleted')
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        return view('investigator.investigator_complaintreportmngt', ['comps'=>$comps]);
    }

    public function complaintreport_form()
    {
        $offenses = Offense::select('*') 
        ->where('not_delete', '=', false)
        ->get();
        return view('investigator.investigator_complaintreportform', ['offenses'=>$offenses]);
    }

    public function index()
    {
        // Define options
        $options = ['Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5'];

        return view('investigator.testing', compact('options'));
    }

    public function submit(Request $request)
    {
        // Handle form submission
        $selectedOptions = $request->input('options');
        // Do something with selected options

        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

    public function offensesmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $offenses = Offense::select('*') 
        ->where('not_delete', '=', false)
        ->get();
        return view('investigator.investigator_offensesmngt', ['offenses'=>$offenses]);
    }

    public function victimsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::
            where('complaint_report_author', $author_id)
            ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('id', 'DESC') 
            ->get();
        return view('investigator.investigator_victimsmngt', ['comps'=>$comps]);
    }

    public function victim_profile($id)
    { 
        $comps = ComplaintReport::  
            where('id', '=', $id)
            ->get();
        return view('investigator.investigator_viewvictimprofile', ['comps'=>$comps]);
    }

    public function suspectsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::
            where('complaint_report_author', $author_id)
            ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('id', 'DESC') 
            ->get();
        return view('investigator.investigator_suspectsmngt', ['comps'=>$comps]);
    }

    public function offender_profile($id)
    { 
        $comps = ComplaintReport::  
            where('id', '=', $id)
            ->get();
        return view('investigator.investigator_viewoffenderprofile', ['comps'=>$comps]);
    }

    public function allrecords()
    {
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', 'notdeleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        return view('investigator.investigator_allrecords', ['comps' => $comps]);
    }

    public function accountmngt()
    {
        $id = Auth::guard('account')->user()->id;
        $accs = Account::where('id', '=', $id)->get();
        // dd($id);
        return view('investigator.investigator_accountmngt', ['accs' => $accs]);
    }

    public function change_passw_request(Request $request)
    {
        $id = Auth::guard('account')->user()->id;
        Account::where('id', '=', $id)
            ->update([
                'change_password_req' => 'pending', 
            ]); 

        $user = Notifications::create([
            'investigator_id' => $id,
            'description' => 'requests to change their password.',
            'status' => 'unread', 
            'read_at' => null,
            'created_at' => Carbon::now(),
        ]); 
    }

    public function filter_allrecords(Request $request)
    { 
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));
 
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_reports.status', 'notdeleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get(); 

        return view('investigator.investigator_allrecords', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function filter_complaintreps(Request $request)
    { 
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));


        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_reports.status', 'notdeleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get(); 

        return view('investigator.investigator_complaintreportmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function filter_victimsmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::
            where('complaint_report_author', $author_id)
            ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
            ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('id', 'DESC') 
            ->get();
        return view('investigator.investigator_victimsmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function filter_offendersmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));
        
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::
            where('complaint_report_author', $author_id)
            ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
            ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('id', 'DESC') 
            ->get();
        return view('investigator.investigator_suspectsmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function change_case_status(Request $request, $id)
    {
        ComplaintReport::where('id', '=', $id)
            ->update([
                'case_disposition' => $request->input('status'), 
            ]);
        return redirect()->back()->with('message', 'Account"s team has been added successfully!');
    }
}
