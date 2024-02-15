<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Employee;
use App\Models\Team;
use App\Models\TeamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function login_view()
    {
        return view('login_view');
    }

    public function login(Request $request){

        $username = $request->input('username');  
        $check = $request->all();

        if(Auth::guard('team')->attempt(['username' => $check['username'], 'password' => $check['password']])){ 
            if (Auth::guard('team')->check()) {  
                $pw = $check['password'];

                $accepted = Team::select('*')->where('username', $username) 
                    ->first();
                // dd('dito dashboard'); 
                return redirect()->route('team.dashboard');
            } else { 
                dd('User not authenticated');
            } 
        }
        else{
            return back()->with('error', 'Invalid credentials'); 
        } 
    }

    public function logout()
    {
        Auth::guard('team')->logout();
        return redirect()->route('login_form')->with('success', 'Team account logged out successfully');
    }

    public function dashboard()
    {
        return view('team.team_dashboard');
    }

    public function testing()
    {
        return view('team.testing');
    }

    public function store(Request $request)
    {
        Employee::create($request->all());
        return back();
    }

    public function complaintreport()
    {
        $author_id = Auth::guard('team')->user()->id;
        $comps = ComplaintReport::join('teams', 'teams.id', '=', 'complaint_reports.complaint_report_author')
        ->select('teams.id as teamid', 'teams.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')->where('complaint_report_author', $author_id)
        ->orderBy('complaint_reports.id', 'DESC')
        ->get();
        return view('team.team_complaintreportmngt', ['comps'=>$comps]);
    }

    public function complaintreport_form()
    {
        return view('team.team_complaintreportform');
    }

    public function index()
    {
        // Define options
        $options = ['Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5'];

        return view('team.testing', compact('options'));
    }

    public function submit(Request $request)
    {
        // Handle form submission
        $selectedOptions = $request->input('options');
        // Do something with selected options
        
        return redirect()->back()->with('success', 'Form submitted successfully.');
    }
}
