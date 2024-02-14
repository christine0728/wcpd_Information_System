<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function add(Request $request){ 
        $team = new Team(); 
        $team->username = $request->input('username');
        $team->password = Hash::make($request->password);
        $team->save();
        return redirect()->back()->with('message', 'The record has been added successfully!');
    }
}
