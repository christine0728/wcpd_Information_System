<?php

namespace App\Http\Controllers;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ComplaintReport;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Offense;
use App\Models\Team;
use App\Models\TeamModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{ 
    public function login_view()
    {
        return view('login_view');
    }

    public function login(Request $request){ 
        $previousUrl = Session::put('previous_url', url()->previous());

        $username = $request->input('username');
        $check = $request->all();

        $validatedData = $request->validate([ 
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if(Auth::guard('account')->attempt(['username' => $check['username'], 'password' => $check['password']])){
            if (Auth::guard('account')->check()) {
                $pw = $check['password'];

                if (NoCaptcha::verifyResponse($request->input('g-recaptcha-response'))) {  
                    $accepted = Account::select('*')->where('username', $username) 
                    ->first();

                    $stat = $accepted->acc_type;
                    $stat2 = $accepted->status;

                    if ($stat == 'superadmin'){ 
                        if ($stat2 == 'active'){  

                            $now = Carbon::now();
                            $now->setTimezone('Asia/Manila'); 
                            $authorID = Auth::guard('account')->user()->id;
                            $fname = Auth::guard('account')->user()->firstname;
                            $lname = Auth::guard('account')->user()->lastname;
                            $log = new Logs();
                            $log->author_type = Auth::guard('account')->user()->acc_type;
                            $log->author_id = $authorID; 
                            $log->action = "Logged In";
                            $log->details = $fname . " " . $lname . " logged in.";
                            $log->created_at = $now;
                            $log->updated_at = $now;
                            $log->save();

                            return redirect()->route('superadmin.dashboard')->with('error', 'investigator account logged in successfully');
                        }
                        else{ 

                            return view('inactive_stat');
                        }
                    }

                    if ($stat == 'investigator'){ 
                        
                        if ($stat2 == 'active'){
                            $ipAddress = $request->getClientIp(); 

                            $now = Carbon::now();
                            $now->setTimezone('Asia/Manila'); 
                            $authorID = Auth::guard('account')->user()->id;
                            $fname = Auth::guard('account')->user()->firstname;
                            $lname = Auth::guard('account')->user()->lastname;
                            $log = new Logs();
                            $log->author_type = Auth::guard('account')->user()->acc_type;
                            $log->author_id = $authorID; 
                            $log->action = "Logged In";
                            $log->details = $fname . " " . $lname . " logged in.";
                            $log->created_at = $now;
                            $log->updated_at = $now;
                            $log->save();
                            
                            return redirect()->route('investigator.dashboard')->with('error', 'investigator account logged in successfully');
                        }
                        else{ 
                            return view('inactive_stat');
                        } 
                    } 


                } else {  
                    return redirect()->back()->withErrors(['captcha' => 'reCAPTCHA validation failed. Please try again.']); 
                }
 
            } else {
                dd('User not authenticated');
            }
        }
        else{
            return back()->with('error', 'The username or password you entered is incorrect.');
        }
    }

    public function logout(Request $request)
    {
        $now = Carbon::now();

        $now->setTimezone('Asia/Manila'); 
        $authorID = Auth::guard('account')->user()->id;
        $fname = Auth::guard('account')->user()->firstname;
        $lname = Auth::guard('account')->user()->lastname;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID; 
        $log->action = "Logged Out";
        $log->details = $fname . " " . $lname . " logged out.";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();

        Auth::guard('account')->logout();
        $request->session()->flush(); 
        $request->session()->regenerate(); 
        
                            
        return redirect()->route('index')->with('success', 'Account logged out successfully');
    }

    public function inactive_screen(Request $request)
    {
        Session::put('previous_url', $request->url());

        return redirect()->route('inactive_screen1');
    }

    public function inactive_screen1(Request $request)
    {
        Session::put('previous_url', $request->url());

        Auth::guard('account')->logout();
        return view('inactive_screen');
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
        $offenses = Offense::get();
        return view('investigator.investigator_complaintreportform', ['offenses'=>$offenses]);
    }

    public function index()
    { 
        $options = ['Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5'];

        return view('investigator.testing', compact('options'));
    }

    public function submit(Request $request)
    { 
        $selectedOptions = $request->input('options'); 

        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

    public function offensesmngt()
    {
        $author_id = Auth::guard('investigator')->user()->id;
        $offenses = Offense::select('*') 
        ->get();
        return view('investigator.investigator_offensesmngt', ['offenses'=>$offenses]);
    }
}
