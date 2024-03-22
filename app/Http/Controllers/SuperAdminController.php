<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ComplaintReport;
use App\Models\Logs;
use App\Models\Notifications;
use App\Models\Offender;
use App\Models\Offense;
use App\Models\SuperAdmin;
use App\Models\Team;
use App\Models\Victim;
use App\Notifications\MyNotification;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

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

        return redirect()->route('superadmin.inv_account_mngt')->with('success', 'Investigator account added successfully!');;
    } 

    public function add_investigator_acc()
    {
        return view('superadmin.superadmin_addinvestigator');
    }

    public function dashboard()
    {
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_dashboard', ['notifs'=>$notifs]);
    }

    public function inv_account_management()
    {
        $invs = Account::where('acc_type', '=', 'investigator') 
            ->where('status', '=', 'active')
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_invaccountmngt', ['invs'=>$invs, 'notifs'=>$notifs]);
    }

    public function edit_investigator_acc($id)
    {
        $invs = Account::where('id', '=', $id) 
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_editinvestigator', ['invs'=>$invs, 'notifs'=>$notifs]);
    }
 
    public function superadmin_account_management($id)
    {
        $invs = Account::where('id', '=', $id) 
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_superadminaccmngt', ['invs'=>$invs, 'notifs'=>$notifs]);
    }
 
    public function change_team(Request $request, $accid)
    {
        Account::where('id', $accid)
            ->update([
                'team' => $request->input('team'), 
            ]);
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return redirect()->back()->with('message', 'Account"s team has been added successfully!');
    }

    public function change_status(Request $request, $accid)
    {
        Account::where('id', $accid)
            ->update([
                'status' => $request->input('status'), 
            ]);
        return redirect()->back()->with('updated', "Investigator account's status has been updated successfully! Moved to Inactive Accounts Tab");
    }

    public function change_password()
    {
        $id = Auth::guard('account')->user()->id;
        $invs = Account::where('id', '=', $id)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_changepassword', ['invs'=>$invs, 'notifs'=>$notifs]);
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
                // dd('napalitan');
                return redirect()->back()->with('updated', "Password changed successfully!");
            }
        }
        else{
            return redirect()->back()->with('delete', 'The username or current password you entered is incorrect.');
        }
    }

    public function victimsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        // $comps = ComplaintReport::
        // // join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        // where('complaint_reports.status', 'notdeleted')
        //     ->orderBy('complaint_reports.id', 'DESC') 
        //     ->get();

        $comps = Victim::join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
            ->select('complaint_reports.id as compid', 'victims.id as vid', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented')
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_victimsmngt', ['comps'=>$comps, 'notifs'=>$notifs]);
    }

    public function victim_profile($id)
    { 
        $comps = Victim::  
            where('id', '=', $id)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_viewvictimprofile', ['comps'=>$comps, 'notifs'=>$notifs]);
    } 

    public function suspectsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        // $comps = ComplaintReport::
        // // join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        // // ->
        // where('complaint_reports.status', 'notdeleted')
        //     ->orderBy('complaint_reports.id', 'DESC') 
        //     ->get();
 
        $comps = Offender::join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
            ->select('complaint_reports.id as compid', 'offenders.id as oid', 'offenders.offender_family_name', 'offenders.offender_firstname', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age')
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_suspectsmngt', ['comps'=>$comps, 'notifs'=>$notifs]);
    }

    public function offender_profile($id)
    { 
        $comps = Offender::  
            where('id', '=', $id)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_viewoffenderprofile', ['comps'=>$comps, 'notifs'=>$notifs]);
    }
        
    public function complaintreportmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition', 'complaint_reports.date_case_updated', 'complaint_reports.case_update')
        ->where('complaint_report_author', $author_id)
        ->where('complaint_reports.status', 'notdeleted')
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
        
        $notifs = Notifications::where('status', '=', 'unread')
        ->count();
        return view('superadmin.superadmin_complaintreportmngt', ['comps'=>$comps, 'notifs'=>$notifs]);
    }

    public function complaintreport_form()
    {
        $offenses = Offense::where('not_delete', '=', false)->get();
        $notifs = Notifications::where('status', '=', 'unread')
        ->count();
        return view('superadmin.superadmin_complaintreportform', ['offenses'=>$offenses, 'notifs'=>$notifs]);
    }

    public function allrecords()
    {
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', 'notdeleted') 
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
    
        $notifs = Notifications::where('status', '=', 'unread')
        ->count();
        return view('superadmin.superadmin_allrecords', ['comps' => $comps, 'notifs'=>$notifs]);
    }

    public function offensesmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $offenses = Offense::select('*') 
        ->where('not_delete', '=', false)
        ->get();
        
        $notifs = Notifications::where('status', '=', 'unread')
        ->count();
        return view('investigator.investigator_offensesmngt', ['offenses'=>$offenses, 'notifs'=>$notifs]);
    } 

    public function filter_allrecords(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->whereBetween('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_reports.status', 'notdeleted') 
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();

        $notifs = Notifications::where('status', '=', 'unread')
        ->count();

        return view('superadmin.superadmin_allrecords', ['comps' => $comps, 'start_date'=>$start_date, 'end_date'=>$end_date, 'notifs'=>$notifs]);
    }

    public function filter_compsmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        // ->where('complaint_report_author', $author_id)
        ->whereBetween('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_report_author', $author_id)
        ->where('complaint_reports.status', 'notdeleted')
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();

        $notifs = Notifications::where('status', '=', 'unread')
        ->count();
        return view('superadmin.superadmin_complaintreportmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date, 'notifs'=>$notifs]);
    }

    public function filter_victimsmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::
            whereBetween('complaint_reports.created_at', '>=', [$start_date, $end_date])
            ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('id', 'DESC') 
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_victimsmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date, 'notifs'=>$notifs]);
    }

    public function filter_offendersmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::
        // join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        // ->
        whereBetween('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->where('complaint_reports.status', 'notdeleted')
            ->orderBy('complaint_reports.id', 'DESC') 
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_suspectsmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date, 'notifs'=>$notifs]);
    }

    public function edit_investigator_details(Request $request, $accid)
    {
        Account::where('id', $accid)
            ->update([
                'firstname' => $request->input('firstname'), 
                'lastname' => $request->input('lastname'), 
                'username' => $request->input('username'), 
                'team' => $request->input('team'), 
            ]);
            
        // route('superadmin.inv_account_mngt')
        return redirect()->back()->with('error', "Updated investigator's account successfully!");
    }

    public function edit_superadmin_acc($id)
    {
        $invs = Account::where('id', '=', $id) 
            ->get();
        return view('superadmin.superadmin_editsuperadmin', ['invs'=>$invs]);
    }

    public function edit_superadmin_details(Request $request, $accid)
    {
        $author_id = Auth::guard('account')->user()->id;
        Account::where('id', $accid)
            ->update([
                'firstname' => $request->input('firstname'), 
                'lastname' => $request->input('lastname'), 
                'username' => $request->input('username'), 
            ]);
        return redirect()->route('superadmin.superadmin_account_mngt', ['id'=>$author_id])->with('updated', "Superadmin's account has been updated successfully!");
    }

    public function change_case_status(Request $request, $id)
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        ComplaintReport::where('id', '=', $id)
            ->update([
                'case_update' => $request->input('status'),
                'date_case_updated' => $now, 
            ]);
        return redirect()->back()->with('updated', 'Updated case disposition successfully!');
    }

    // public function sendNotification()
    // {
    //     $user = Auth::user();
    //     $user->notify(new MyNotification());

    //     return redirect()->back()->with('success', 'Notification sent successfully');
    // }

    public function password_requests(Request $request)
    { 
        $notifications = Notifications::join('accounts', 'accounts.id', '=', 'notifications.investigator_id')  
            ->select('accounts.firstname', 'accounts.lastname', 'accounts.id as iid', 'notifications.description', 'notifications.created_at', 'notifications.id as nid', 'notifications.status')  
            ->orderBy('notifications.id', 'desc')
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        // dd('and2');
        return view('superadmin.superadmin_password_requests', ['notifications' => $notifications, 'notifs'=>$notifs]);
    }

    public function inv_changepass_req($nid, $id)
    {
        $invs = Notifications::join('accounts', 'accounts.id', '=', 'notifications.investigator_id')  
            ->select('accounts.firstname', 'accounts.lastname', 'accounts.username', 'accounts.team', 'accounts.id', 'accounts.change_password_req', 'notifications.id as nid')  
            ->where('notifications.id', '=', $nid)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_inv_changepassw', ['invs'=>$invs, 'nid'=>$nid, 'notifs'=>$notifs]);
    }

    public function inv_changepass_req_post(Request $request, $nid, $id)
    {
        Notifications::where('id', $nid)
            ->update([
                'status' => 'read', 
            ]);

        Account::where('id', $id)
            ->update([
                'change_password_req' => $request->input('passw_req'), 
            ]);
            
        // route('superadmin.inv_account_mngt')
        return redirect()->route('superadmin.password_requests')->with('success', 'Investigator account added successfully!');
    }

    public function logs()
    {
        $logs = Logs::join('accounts', 'accounts.id', '=', 'logs.author_id')  
            ->select('accounts.firstname', 'accounts.lastname', 'logs.author_type', 'logs.id', 'logs.action', 'logs.details', 'logs.created_at') 
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_logs', ['logs'=>$logs, 'notifs'=>$notifs]);
    }

    public function filter_logs(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $author_id = Auth::guard('account')->user()->id; 
        $logs = Logs::join('accounts', 'accounts.id', '=', 'logs.author_id')  
            ->select('accounts.firstname', 'accounts.lastname', 'logs.author_type', 'logs.id', 'logs.action', 'logs.details', 'logs.created_at') 
            ->whereDate('logs.created_at', '>=', $start_date)
            ->whereDate('logs.created_at', '<=', $end_date)
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
            
        return view('superadmin.superadmin_logs', ['logs'=>$logs, 'notifs'=>$notifs, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function trash()
    {
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', 'deleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_deletedforms', ['comps' => $comps, 'notifs'=>$notifs]);
    }
} 
