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
            'acc_status' => 'superadmin',
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
            'acc_status' => 'investigator',
            'team' => $request->input('team'),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message', 'The record has been added successfully!');
    } 
}
