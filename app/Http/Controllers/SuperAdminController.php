<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
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
}
