<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintReport;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Offense;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use App\Models\Notifications;
use App\Models\Offender;
use App\Models\Team;
use App\Models\TeamModel;
use App\Models\Victim;
use App\Notifications\MyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $filter_year = null;
        $filter_year1 = null; 
        $crimeData = DB::table('complaint_reports')
        ->join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select(
            DB::raw('MONTH(date_reported) as month'),
            DB::raw('COUNT(*) as total_cases'),
            'offenses',
            'offender_sex'
        )
        ->groupBy('month', 'offenses', 'offender_sex')
        ->orderBy('month')
        ->get(); 

        $comps = DB::table('complaint_reports as cr')
        ->join('victims as v', 'v.comp_report_id', '=', 'cr.id')
        ->select(
            DB::raw('DATE_FORMAT(cr.date_reported, "%b") AS comp_month'),
            DB::raw('COUNT(cr.id) AS total_comps'),
            DB::raw('SUM(CASE WHEN v.victim_sex = "MALE" THEN 1 ELSE 0 END) AS male_total_comps'),
            DB::raw('SUM(CASE WHEN v.victim_sex = "FEMALE" THEN 1 ELSE 0 END) AS female_total_comps'),
            DB::raw('GROUP_CONCAT(DISTINCT cr.offenses) AS offense')
        )
        ->groupBy('comp_month')
        ->orderBy(DB::raw('MONTH(cr.date_reported)'))
        ->get();
     
        $comps11 = ComplaintReport::join('victims', function ($join) {
            $join->on('victims.comp_report_id', '=', 'complaint_reports.id')
                    ->where('victims.victim_sex', '=', 'FEMALE');
            })
            ->select(
                DB::raw('CASE 
                    WHEN victims.victim_age BETWEEN 0 AND 17 THEN "0-17" 
                    ELSE "18+"
                END AS age_range'), 
                DB::raw('COUNT(complaint_reports.id) AS total_comps')
            ) 
            ->groupBy('age_range')
            ->get();

        $comps_male = ComplaintReport::join('victims', function ($join) {
            $join->on('victims.comp_report_id', '=', 'complaint_reports.id')
                    ->where('victims.victim_sex', '=', 'MALE');
            })
            ->select(
                DB::raw('CASE 
                    WHEN victims.victim_age BETWEEN 0 AND 17 THEN "0-17" 
                    ELSE "18+"
                END AS age_range'), 
                DB::raw('COUNT(complaint_reports.id) AS total_comps')
            ) 
            ->groupBy('age_range')
            ->get();
    

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
       
            //#4 ilan yung victim na babae at lalake
        $maleVictim = DB::table('victims')->where('victim_sex', 'MALE')->count();
        $femaleVictim = DB::table('victims')->where('victim_sex', 'FEMALE')->count();
        $maleOffenders = DB::table('offenders')->where('offender_sex', 'MALE')->count();
        $femaleOffenders = DB::table('offenders')->where('offender_sex', 'FEMALE')->count(); 


        $topPlaces = DB::table('complaint_reports')
        ->select('place_of_commission', DB::raw('COUNT(*) as total_cases'))
        ->groupBy('place_of_commission')
        ->orderByDesc('total_cases')
        ->limit(5)
        ->get();
   
        $relationshipCounts = DB::table('offenders')
        // ->join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        // ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        // ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select(
            'offender_relationship_victim',
            DB::raw('SUM(CASE WHEN offender_sex = "MALE" THEN 1 ELSE 0 END) AS male_count'),
            DB::raw('SUM(CASE WHEN offender_sex = "FEMALE" THEN 1 ELSE 0 END) AS female_count')
        )
        ->groupBy('offender_relationship_victim')
        ->get(); 
        return view('investigator.investigator_dashboard',  ['relationshipCounts'=> $relationshipCounts,'topPlaces'=>$topPlaces, 'maleOffenders'=>$maleOffenders, 'femaleOffenders'=>$femaleOffenders, 'maleVictim'=>$maleVictim, 'femaleVictim'=>$femaleVictim, 'notifs'=>$notifs, 'comps'=>$comps, 'comps11'=>$comps11, 'comps_male'=>$comps_male, 'filter_year'=>$filter_year, 'filter_year1'=>$filter_year1]);
    }

    public function filter_dashboard(Request $request)
    {
        $filter_year = null;
        $filter_year1 = null; 

        // $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        // $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $start_month = date('m', strtotime($request->input('start_date')));
        $end_month = date('m', strtotime($request->input('end_date'))); 

        $crimeData = DB::table('complaint_reports')
        ->join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select(
            DB::raw('MONTH(date_reported) as month'),
            DB::raw('COUNT(*) as total_cases'),
            'offenses',
            'offenders.offender_sex'
        )
        ->whereRaw('MONTH(complaint_reports.date_reported) >= ?', [$start_month])
        ->whereRaw('MONTH(complaint_reports.date_reported) <= ?', [$end_month]) 
        ->groupBy('month', 'offenses', 'offenders.offender_sex')
        ->orderBy('month')
        ->get();
    
        $comps = DB::table('complaint_reports as cr')
        ->join('victims as v', 'v.comp_report_id', '=', 'cr.id')
        ->select(
            DB::raw('DATE_FORMAT(cr.date_reported, "%b") AS comp_month'),
            DB::raw('COUNT(cr.id) AS total_comps'),
            DB::raw('SUM(CASE WHEN v.victim_sex = "MALE" THEN 1 ELSE 0 END) AS male_total_comps'),
            DB::raw('SUM(CASE WHEN v.victim_sex = "FEMALE" THEN 1 ELSE 0 END) AS female_total_comps'),
            DB::raw('GROUP_CONCAT(DISTINCT cr.offenses) AS offense')
        )
        ->whereRaw('MONTH(cr.date_reported) >= ?', [$start_month])
        ->whereRaw('MONTH(cr.date_reported) <= ?', [$end_month]) 
        ->groupBy('comp_month')
        ->orderBy(DB::raw('MONTH(cr.date_reported)'))
        ->get();
     
        $comps11 = ComplaintReport::join('victims', function ($join) {
            $join->on('victims.comp_report_id', '=', 'complaint_reports.id')
                    ->where('victims.victim_sex', '=', 'FEMALE');
            })
            ->select(
                DB::raw('CASE 
                    WHEN victims.victim_age BETWEEN 0 AND 17 THEN "0-17" 
                    ELSE "18+"
                END AS age_range'), 
                DB::raw('COUNT(complaint_reports.id) AS total_comps')
            ) 
            ->whereRaw('MONTH(complaint_reports.date_reported) >= ?', [$start_month])
            ->whereRaw('MONTH(complaint_reports.date_reported) <= ?', [$end_month]) 
            ->groupBy('age_range')
            ->get();

        $comps_male = ComplaintReport::join('victims', function ($join) {
            $join->on('victims.comp_report_id', '=', 'complaint_reports.id')
                    ->where('victims.victim_sex', '=', 'MALE');
            })
            ->select(
                DB::raw('CASE 
                    WHEN victims.victim_age BETWEEN 0 AND 17 THEN "0-17" 
                    ELSE "18+"
                END AS age_range'), 
                DB::raw('COUNT(complaint_reports.id) AS total_comps')
            ) 
            ->whereRaw('MONTH(complaint_reports.date_reported) >= ?', [$start_month])
            ->whereRaw('MONTH(complaint_reports.date_reported) <= ?', [$end_month]) 
            ->groupBy('age_range')
            ->get();
    

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        
        $maleVictim = DB::table('victims')->where('victim_sex', 'MALE')
        ->whereRaw('MONTH(victims.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(victims.created_at) <= ?', [$end_month])
        ->count();
        
        $femaleVictim = DB::table('victims')->where('victim_sex', 'FEMALE')
        ->whereRaw('MONTH(victims.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(victims.created_at) <= ?', [$end_month]) 
        ->count();
        $maleOffenders = DB::table('offenders')->where('offender_sex', 'MALE')
        ->whereRaw('MONTH(offenders.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(offenders.created_at) <= ?', [$end_month])
        ->count();
        $femaleOffenders = DB::table('offenders')->where('offender_sex', 'FEMALE')
        ->whereRaw('MONTH(offenders.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(offenders.created_at) <= ?', [$end_month]) 
        ->count(); 


        $topPlaces = DB::table('complaint_reports')
        ->select('place_of_commission', DB::raw('COUNT(*) as total_cases'))
        ->whereRaw('MONTH(complaint_reports.date_reported) >= ?', [$start_month])
        ->whereRaw('MONTH(complaint_reports.date_reported) <= ?', [$end_month]) 
        ->groupBy('place_of_commission')
        ->orderByDesc('total_cases')
        ->limit(5)
        ->get();
   
        $relationshipCounts = DB::table('complaint_reports')
        ->join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select(
            'offender_relationship_victim',
            DB::raw('SUM(CASE WHEN offender_sex = "MALE" THEN 1 ELSE 0 END) AS male_count'),
            DB::raw('SUM(CASE WHEN offender_sex = "FEMALE" THEN 1 ELSE 0 END) AS female_count')
        )
        ->whereRaw('MONTH(complaint_reports.date_reported) >= ?', [$start_month])
        ->whereRaw('MONTH(complaint_reports.date_reported) <= ?', [$end_month]) 
        ->groupBy('offender_relationship_victim')
        ->get();
 
        return view('investigator.investigator_dashboard', ['relationshipCounts'=> $relationshipCounts,'topPlaces'=>$topPlaces, 'maleOffenders'=>$maleOffenders, 'femaleOffenders'=>$femaleOffenders, 'maleVictim'=>$maleVictim, 'femaleVictim'=>$femaleVictim, 'notifs'=>$notifs, 'comps'=>$comps, 'comps11'=>$comps11, 'comps_male'=>$comps_male, 'filter_year'=>$filter_year, 'filter_year1'=>$filter_year1]);
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
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.inv_case_no', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition', 'complaint_reports.date_case_updated', 'complaint_reports.case_update')->where('complaint_report_author', $author_id)
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
        $comps = Victim::join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
            ->select('complaint_reports.id as compid', 'victims.id as vid', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'victims.victim_image', 'victims.victim_present_address', 'complaint_reports.date_reported')
            ->where('complaint_reports.complaint_report_author', '=', $author_id)
            ->orderByDesc('victims.id')
            ->get();
        return view('investigator.investigator_victimsmngt', ['comps'=>$comps]);
    }

    public function victim_profile($id)
    { 
        $comps = Victim::  
            where('id', '=', $id)
            ->get();
        return view('investigator.investigator_viewvictimprofile', ['comps'=>$comps]);
    }

    public function suspectsmngt()
    {
        $author_id = Auth::guard('account')->user()->id;
        $comps = Offender::join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->select('complaint_reports.id as compid', 'offenders.id as oid', 'offenders.offender_family_name', 'offenders.offender_firstname', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age','offenders.offender_image', 'offenders.offender_prev_criminal_rec', 'offenders.offender_relationship_victim', 'complaint_reports.date_reported')
        ->where('complaint_reports.complaint_report_author', '=', $author_id)
        ->orderBy('offenders.id', 'desc')
        ->get();
        return view('investigator.investigator_suspectsmngt', ['comps'=>$comps]);
    }

    public function offender_profile($id)
    { 
        $comps = Offender::  
            where('id', '=', $id)
            ->get();
        return view('investigator.investigator_viewoffenderprofile', ['comps'=>$comps]);
    }

    public function allrecords()
    {
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.inv_case_no', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
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
    
        $chang_passw = Auth::guard('account')->user()->change_passw_request; 
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

        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

    public function filter_allrecords(Request $request)
    { 
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));
 
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->whereDate('complaint_reports.created_at', '>=', $start_date)
        ->whereDate('complaint_reports.created_at', '<=', $end_date)
        ->where('complaint_reports.status', 'notdeleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get(); 

        return view('investigator.investigator_allrecords', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function filter_complaintreps(Request $request)
    { 
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
 
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition', 'complaint_reports.date_case_updated', 'complaint_reports.case_update')
        ->whereDate('complaint_reports.created_at', '>=', $start_date)
        ->whereDate('complaint_reports.created_at', '<=', $end_date)
        ->where('complaint_reports.status', 'notdeleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get(); 

        return view('investigator.investigator_complaintreportmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function filter_victimsmngt(Request $request)
    {
        $team = Auth::guard('account')->user()->team;
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        $author_id = Auth::guard('account')->user()->id;
        $comps = Victim::join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
        // ->join('accounts', 'accounts.id', '=', 'complaint_reports.id')
        ->select('complaint_reports.id as compid', 'victims.id as vid', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'victims.victim_image', 'victims.victim_present_address', 'complaint_reports.date_reported')
        // ->where('complaint_reports.complaint_report_author', $author_id)
        // ->where('accounts.team', $team)
        // ->where('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->whereDate('complaint_reports.date_reported', '>=', $start_date)
        ->whereDate('complaint_reports.date_reported', '<=', $end_date)
        ->where('complaint_reports.status', 'notdeleted')
        ->orderBy('victims.id', 'DESC') 
        ->get();
        return view('investigator.investigator_victimsmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function filter_offendersmngt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));
        
        $author_id = Auth::guard('account')->user()->id;
        $comps = Offender::join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->select('complaint_reports.id as compid', 'offenders.id as oid', 'offenders.offender_family_name', 'offenders.offender_firstname', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age','offenders.offender_image', 'offenders.offender_prev_criminal_rec', 'offenders.offender_relationship_victim', 'complaint_reports.date_reported')
        ->orderByDesc('offenders.id')
        ->whereDate('complaint_reports.created_at', '>=', $start_date)
        ->whereDate('complaint_reports.created_at', '<=', $end_date)
        ->where('complaint_reports.complaint_report_author', '=', $author_id) 
        ->get();
        return view('investigator.investigator_suspectsmngt', ['comps'=>$comps, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function change_case_status(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'status' => ['required'], 
        ], [
            'status.required' => 'The status field is required.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else{
            $now = Carbon::now();
            $now->setTimezone('Asia/Manila');
            
            ComplaintReport::where('id', $id)->update([
                'case_update' => $request->input('status'),
                'date_case_updated' => $now,
            ]);
            
            return redirect()->back()->with('message', 'Case status has been updated successfully!');
       
        }
        
      }
    
    public function change_password()
    {
        $id = Auth::guard('account')->user()->id;
        $invs = Account::where('id', '=', $id)
            ->get();
        return view('investigator.investigator_changepassword', ['invs'=>$invs]);
    }
    public function changing_password(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'curr_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:12',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/' 
            ],
        ], [
            'new_password.max' => 'The new password must not exceed 12 characters in length.',
            'new_password.regex' => 'The new password must contain at least 8 letters, at least one number, and at least one special character.'
        ]);
     
        // $validator->sometimes('new_password', 'regex:/[a-zA-Z]/', function ($input) {
        //     return !preg_match('/[a-zA-Z]/', $input->new_password);
        // }, function ($validator) {
        //     $validator->errors()->add('new_password', 'The new password must contain at least one letter.');
        // });

        // $validator->sometimes('new_password', ['required', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/'], function ($input) {
        //     return true;  
        // }, function ($validator) {
        //     $validator->errors()->add('new_password', 'The new password must contain at least 8 letters, at least one number, and at least one special character.');
        // });

        // $validator->sometimes('new_password', ['required', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/'], function ($input) {
        //     return true; 
        // }, function ($validator) {
        //     $validator->errors()->add('new_password', 'The new password must contain at least 8 letters and at least one number.');
        // }); 
    
        // $validator->sometimes('new_password', 'regex:/\d/', function ($input) {
        //     return !preg_match('/\d/', $input->new_password);
        // }, function ($validator) {
        //     $validator->errors()->add('new_password', 'The new password must contain at least one number.');
        // });
     
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
     
        $id = Auth::guard('account')->user()->id;
     
        if (Auth::guard('account')->attempt(['username' => $request->input('username'), 'password' => $request->input('curr_password')])) { 
            Account::where('id', $id)->update([
                'password' => Hash::make($request->input('new_password')),
                'change_password_req' => 'done', 
            ]);
     
            return redirect()->route('investigator.accountmngt')->with('success', 'Password changed successfully!');
        } else { 
            return redirect()->back()->with('error', 'Username or current password you entered is incorrect.')->withInput();
        }
    }

    public function logs()
    {
        $author_id = Auth::guard('account')->user()->id;
        $logs = Logs::join('accounts', 'accounts.id', '=', 'logs.author_id')  
        ->select('accounts.firstname', 'accounts.lastname', 'logs.author_type', 'logs.id', 'logs.action', 'logs.details', 'logs.created_at') 
        ->where('logs.author_id', '=', $author_id)
        ->orderBy('logs.created_at', 'DESC') // Ordering by created_at column in descending order
        ->get();
    
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('investigator.investigator_logs', ['logs'=>$logs, 'notifs'=>$notifs]);
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
            ->orderBy('logs.id', 'DESC') 
            ->where('logs.author_id', '=', $author_id)
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
            
        return view('investigator.investigator_logs', ['logs'=>$logs, 'notifs'=>$notifs, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function trash()
    {
        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', 'deleted')
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
    
        return view('investigator.investigator_deletedforms', ['comps' => $comps]);
    }

    public function filter_trash(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $team = Auth::guard('account')->user()->team;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', 'deleted')
        ->whereDate('complaint_reports.created_at', '>=', $start_date)
        ->whereDate('complaint_reports.created_at', '<=', $end_date)
        ->where('accounts.team', $team)
        ->orderBy('complaint_reports.id', 'DESC') 
        ->get();
 
        return view('investigator.investigator_deletedforms', ['comps' => $comps]);
    }
}
