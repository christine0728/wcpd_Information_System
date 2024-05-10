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
use App\Rules\UniqueUsernameAdmin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function add_superadmin(Request $request){ 

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

        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'regex:/^[a-zA-Z0-9_]{8,12}$/
            ', new UniqueUsernameAdmin],
        ], [
            'firstname.required' => 'This field is required.',
            'firstname.regex' => 'This field must contain letters only.',
            'lastname.required' => 'This field is required.',
            'lastname.regex' => 'This field must contain letters only.',
            'username.regex' => 'This field must contain at least 8 to 12 characters.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $notifs = Notifications::where('status', '=', 'unread')
        ->count();
        return view('superadmin.superadmin_addinvestigator', ['notifs'=>$notifs]);
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
            'offenders.offender_sex',
            'offenders.offender_relationship_victim as offender_relationship_victim'
        )
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->groupBy('month', 'offenses', 'offenders.offender_sex', 'offenders.offender_relationship_victim')
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
        ->where('cr.status', '=', 'notdeleted')
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
            ->where('complaint_reports.status', '=', 'notdeleted')
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
            ->where('complaint_reports.status', '=', 'notdeleted')
            ->groupBy('age_range')
            ->get();


        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
 
        $maleVictim = DB::table('victims')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
        ->where('victim_sex', 'MALE')
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();

        $femaleVictim = DB::table('victims')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
        ->where('victim_sex', 'FEMALE')
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();

        $maleOffenders = DB::table('offenders')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->where('offenders.offender_sex', 'MALE')
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();

        $femaleOffenders = DB::table('offenders')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->where('offenders.offender_sex', 'FEMALE')
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();


        $topPlaces = DB::table('complaint_reports')
        ->select('place_of_commission', DB::raw('COUNT(*) as total_cases'))
        ->where('status', '=', 'notdeleted')
        ->groupBy('place_of_commission')
        ->orderByDesc('total_cases')
        ->limit(5)
        ->get();

        $relationshipCounts = DB::table('offenders')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->select(
            'offenders.offender_relationship_victim',
            DB::raw('SUM(CASE WHEN offenders.offender_sex = "MALE" THEN 1 ELSE 0 END) AS male_count'),
            DB::raw('SUM(CASE WHEN offenders.offender_sex = "FEMALE" THEN 1 ELSE 0 END) AS female_count')
        )
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->groupBy('offenders.offender_relationship_victim')
        ->get();

        return view('superadmin.superadmin_dashboard', ['relationshipCounts'=> $relationshipCounts,'topPlaces'=>$topPlaces, 'maleOffenders'=>$maleOffenders, 'femaleOffenders'=>$femaleOffenders, 'maleVictim'=>$maleVictim, 'femaleVictim'=>$femaleVictim, 'notifs'=>$notifs, 'comps'=>$comps, 'comps11'=>$comps11, 'comps_male'=>$comps_male, 'filter_year'=>$filter_year, 'filter_year1'=>$filter_year1]);
    }

    public function filter_dashboard(Request $request)
    {
        $filter_year = null;
        $filter_year1 = null;
  
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
        ->where('cr.status', '=', 'notdeleted')
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
            ->where('complaint_reports.status', '=', 'notdeleted')
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
            ->where('complaint_reports.status', '=', 'notdeleted')
            ->groupBy('age_range')
            ->get();


        $notifs = Notifications::where('status', '=', 'unread')
            ->count();

        $maleVictim = DB::table('victims')->where('victim_sex', 'MALE')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
        ->whereRaw('MONTH(victims.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(victims.created_at) <= ?', [$end_month])
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();

        $femaleVictim = DB::table('victims')->where('victim_sex', 'FEMALE')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
        ->whereRaw('MONTH(victims.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(victims.created_at) <= ?', [$end_month])
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();

        $maleOffenders = DB::table('offenders')->where('offender_sex', 'MALE')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->whereRaw('MONTH(offenders.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(offenders.created_at) <= ?', [$end_month])
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();

        $femaleOffenders = DB::table('offenders')->where('offender_sex', 'FEMALE')
        ->join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
        ->whereRaw('MONTH(offenders.created_at) >= ?', [$start_month])
        ->whereRaw('MONTH(offenders.created_at) <= ?', [$end_month])
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->count();


        $topPlaces = DB::table('complaint_reports')
        ->select('place_of_commission', DB::raw('COUNT(*) as total_cases'))
        ->whereRaw('MONTH(complaint_reports.date_reported) >= ?', [$start_month])
        ->whereRaw('MONTH(complaint_reports.date_reported) <= ?', [$end_month])
        ->where('status', '=', 'notdeleted')
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
        ->where('complaint_reports.status', '=', 'notdeleted')
        ->groupBy('offender_relationship_victim')
        ->get();

        return view('superadmin.superadmin_dashboard', ['relationshipCounts'=> $relationshipCounts,'topPlaces'=>$topPlaces, 'maleOffenders'=>$maleOffenders, 'femaleOffenders'=>$femaleOffenders, 'maleVictim'=>$maleVictim, 'femaleVictim'=>$femaleVictim, 'notifs'=>$notifs, 'comps'=>$comps, 'comps11'=>$comps11, 'comps_male'=>$comps_male, 'filter_year'=>$filter_year, 'filter_year1'=>$filter_year1]);
    }

    public function inv_account_management()
    {
        $invs = Account::where('acc_type', '=', 'investigator')
            ->where('status', '=', 'active')
            ->get();

        $inacts = Account::where('acc_type', '=', 'investigator')
            ->where('status', '=', 'inactive')
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_invaccountmngt', ['invs'=>$invs, 'inacts'=>$inacts, 'notifs'=>$notifs]);
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
        if ($request->input('status') == null){
            return redirect()->back()->with('updated', "Select on the dropdown to change the Investigator account's status.");
        }
        else{
            Account::where('id', $accid)
            ->update([
                'status' => $request->input('status'),
            ]);

            return redirect()->back()->with('updated', "Investigator account's status has been updated successfully!");
        }

    }

    public function change_password()
    {
        $id = Auth::guard('account')->user()->id;

        $superadmin = Account::find($id);
        $lastpswrdchange = $superadmin->last_change_password;
        $lastpswrdchange = Carbon::parse($lastpswrdchange)->format('F d, Y');

        if (Carbon::parse($lastpswrdchange)->diffInDays(Carbon::now()) >= 30) {
            $pswordchangereq = true;
        } else {
            $pswordchangereq = false;
        }

        $lastPasswordChangeDate = Carbon::parse($lastpswrdchange);
        $currentDate = Carbon::now();
        $daysremaining = 30 - $lastPasswordChangeDate->diffInDays($currentDate);

        $invs = Account::where('id', '=', $id)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_changepassword', ['invs'=>$invs, 'notifs'=>$notifs, 'pswordchangereq'=>$pswordchangereq, 'lastpswrdchange'=>$lastpswrdchange, 'daysremaining'=>$daysremaining]);
    }

    public function changing_password(Request $request)
    {
        $id = Auth::guard('account')->user()->id;
        $username = $request->input('username');
        $invs = Account::where('id', '=', $id)
            ->first();
        $check = $request->all(); 

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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = Auth::guard('account')->user()->id;

        if (Auth::guard('account')->attempt(['username' => $request->input('username'), 'password' => $request->input('curr_password')])) {
            Account::where('id', $id)->update([
                'password' => Hash::make($request->input('new_password')),
                'change_password_req' => 'done',
            ]);

            return redirect()->route('superadmin.superadmin_account_mngt', ['id'=>$id])->with('success', "Password changed successfully!");
        } else {
            return redirect()->back()->with('error', 'Username or current password you entered is incorrect.')->withInput();
        }
    }

    public function victimsmngt()
    {
        $author_id = Auth::guard('account')->user()->id; 

        $comps = Victim::join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
            ->select('complaint_reports.id as compid', 'victims.id as vid', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'victims.victim_image', 'victims.victim_present_address', 'complaint_reports.date_reported')
            ->orderBy('victims.id', 'desc')
            ->where('complaint_reports.status', '=', 'notdeleted') 
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
        $comps = Offender::join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
            ->select('complaint_reports.id as compid', 'offenders.id as oid', 'offenders.offender_family_name', 'offenders.offender_firstname', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age','offenders.offender_image', 'offenders.offender_prev_criminal_rec', 'offenders.offender_relationship_victim', 'complaint_reports.date_reported')
            ->orderByDesc('offenders.id')
            ->where('complaint_reports.status', '=', 'notdeleted') 
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
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.inv_case_no', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition', 'complaint_reports.date_case_updated', 'complaint_reports.case_update') 
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

        $accs = Account::get();
        return view('superadmin.superadmin_complaintreportform', ['offenses'=>$offenses, 'notifs'=>$notifs, 'accs'=>$accs]);
    }

    public function allrecords()
    {
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.inv_case_no', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
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
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');

        $start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d', strtotime($request->input('end_date')));

        if ($end_date == ""){
            $end_date = $now->format('Y-m-d');
        }

        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        // ->whereBetween('complaint_reports.created_at', '>=', [$start_date, $end_date])
        ->whereDate('complaint_reports.date_reported', '>=', $start_date)
        ->whereDate('complaint_reports.date_reported', '<=', $end_date)
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
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.complaint_report_author')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition', 'complaint_reports.date_case_updated', 'complaint_reports.case_update')
        // ->where('complaint_report_author', $author_id)
        ->whereDate('complaint_reports.date_reported', '>=', $start_date)
        ->whereDate('complaint_reports.date_reported', '<=', $end_date)
        // ->where('complaint_report_author', $author_id)
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
        $comps = Victim::join('complaint_reports', 'complaint_reports.id', '=', 'victims.comp_report_id')
            ->select('complaint_reports.id as compid', 'victims.id as vid', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'victims.victim_image', 'victims.victim_present_address', 'complaint_reports.date_reported')
            ->where('complaint_reports.status', 'notdeleted')
            ->whereDate('complaint_reports.date_reported', '>=', $start_date)
            ->whereDate('complaint_reports.date_reported', '<=', $end_date)
            ->orderBy('victims.id', 'DESC')
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
            $comps = Offender::join('complaint_reports', 'complaint_reports.id', '=', 'offenders.comp_report_id')
            ->select('complaint_reports.id as compid', 'offenders.id as oid', 'offenders.offender_family_name', 'offenders.offender_firstname', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age','offenders.offender_image', 'offenders.offender_prev_criminal_rec', 'offenders.offender_relationship_victim', 'complaint_reports.date_reported')
            ->orderByDesc('offenders.id')
            ->whereDate('complaint_reports.created_at', '>=', $start_date)
            ->whereDate('complaint_reports.created_at', '<=', $end_date)
            ->where('complaint_reports.status', 'notdeleted')
            // ->where('complaint_reports.complaint_report_author', '=', $author_id)
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
        return redirect()->route('superadmin.inv_account_mngt')->with('updated', "Updated investigator's account successfully!");
    }

    public function edit_superadmin_acc($id)
    {
        $invs = Account::where('id', '=', $id)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_editsuperadmin', ['invs'=>$invs, 'notifs'=>$notifs]);
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

        $authorID = Auth::guard('account')->user()->id;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID;
        $log->details = "Updated Case Disposition of Complaint Report Form";
        $log->action = "Update";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();
        return redirect()->back()->with('updated', 'Updated case disposition successfully!');
    } 

    public function password_requests(Request $request)
    {
        $notifications = Notifications::join('accounts', 'accounts.id', '=', 'notifications.investigator_id')
            ->select('accounts.firstname', 'accounts.lastname', 'accounts.id as iid', 'notifications.description', 'notifications.created_at', 'notifications.id as nid', 'notifications.status')
            ->orderBy('notifications.id', 'desc')
            ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count(); 
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
            ->select('logs.id as lid', 'accounts.firstname', 'accounts.lastname', 'logs.author_type', 'logs.id', 'logs.action', 'logs.details', 'logs.created_at')
            ->orderByDesc('logs.id')
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
        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::leftJoin('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
        ->leftJoin('victims', 'victims.comp_report_id', '=', 'complaint_reports.id')
        ->leftJoin('offenders', 'offenders.comp_report_id', '=', 'complaint_reports.id')
        ->select('accounts.id as accountid', 'accounts.username', 'accounts.team', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'victims.victim_family_name', 'victims.victim_firstname', 'victims.victim_middlename', 'victims.victim_sex', 'victims.victim_age', 'victims.victim_docs_presented', 'offenders.offender_firstname', 'offenders.offender_family_name', 'offenders.offender_middlename', 'offenders.offender_sex', 'offenders.offender_age', 'offenders.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')
        ->where('complaint_reports.status', '=', 'deleted')
        ->where('complaint_reports.complaint_report_author', $author_id)
        ->orderBy('complaint_reports.id', 'DESC')
        ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_deletedforms', ['comps' => $comps, 'notifs'=>$notifs]);
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
        ->orderBy('complaint_reports.id', 'DESC')
        ->get();

        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_deletedforms', ['comps' => $comps, 'notifs'=>$notifs]);
    }

    public function prescriptive_forecasting(){

        $filter_year = null;
        $filter_year1 = null;
        $fid =  Auth::guard('fishfarmer')->user()->location;
        $ffid =Auth::guard('fishfarmer')->user()->fishfarmID;

        $comps = ComplaintReport::select(
            DB::raw('DATE_FORMAT(date_reported, "%b") AS comp_month'),
            DB::raw('COUNT(complaikn) AS total_comps')
        )
        ->groupBy('comp_month')
        ->orderBy(DB::raw('MONTH(date_reported)'))
        ->get();


        return view('superadmin.superadmin_dashboard', ['comps'=>$comps, 'filter_year'=>$filter_year, 'filter_year1'=>$filter_year1
        ]);
    }
}
