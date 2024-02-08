<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('team.team_complaintreportmngt');
    }

    public function complaintreport_form()
    {
        return view('team.team_complaintreportform');
    }
}
