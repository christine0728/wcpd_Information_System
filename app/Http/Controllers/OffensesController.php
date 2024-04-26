<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OffensesController extends Controller
{
    public function add(Request $request)
    {
        $currentUserId = Auth::id();
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        $name = $request->input('offense_name');
        $desc = $request->input('description'); 

        $validator = Validator::make($request->all(), [ 
            'offense_name' => ['required', 'regex:/^[a-zA-Z\s.]+$/'],   
            'description' => ['required', 'regex:/^[a-zA-Z\s.]+$/'], 
        ], [ 
            'offense_name.required' => 'This field is required.',
            'offense_name.regex' => 'This field must contain only letters and periods.',
            'description.required' => 'This field is required.',
            'description.regex' => 'This field must contain only letters and periods.'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('delete', 'Inputs are either empty or invalid.'); 
        }
 
        $offenses = new Offense([
            'offense_name' => $name,
            'description' => $desc,
            'not_delete' => false,
        ]);
        
        $offenses->save();
        return redirect()->back()->with('success', 'Offense has been added successfully!');
    }

    public function delete(Request $request, $offensepid) {  
        Offense::where('id', $offensepid)
            ->update([
                'not_delete' => true, 
            ]);

        $type = Auth::guard('account')->user()->acc_type;
        if ($type == 'investigator'){
            return redirect()->route('investigator.offensesmanagement')->with('delete', 'Offense has been deleted successfully!'); 
        }
        elseif ($type == 'superadmin'){
            return redirect()->route('superadmin.offensesmanagement')->with('delete', 'Offense has been deleted successfully!'); 
        }
    }
    public function update(Request $request)
    {
        $currentUserId = Auth::id();
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        $id= $request->input('edit_id');
        $offensename= $request->input('edit_offense');
        $desc= $request->input('edit_desc');
        $offense = Offense::find($id);
        $offense->offense_name = $offensename;
        $offense->description = $desc;
        $offense->updated_at = $now;
        $offense->update();
        return redirect()->back()->with('updated', 'Offense has been updated successfully!');
    }

    public function filter(Request $request)
    { 
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $offenses = Offense::whereBetween('offenses.created_at', [$start_date, $end_date])
        ->orderBy('offenses.created_at', 'desc')
        ->paginate();

        return view('investigator.investigator_offensesmngt', ['offenses'=>$offenses]);
    }
}

