<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffensesController extends Controller
{
    public function add(Request $request)
    {
        $currentUserId = Auth::id();
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        $name = $request->input('offense_name');
        $desc = $request->input('description');
        $offenses = new Offense([
            'offense_name' => $name,
            'description' => $desc,
            'not_delete' => false,
        ]);
        $offenses->save();
        return redirect()->back()->with('success', 'The record has been added successfully!');
    }

    public function delete(Request $request, $offensepid) {  
        Offense::where('id', $offensepid)
            ->update([
                'not_delete' => true, 
            ]);

        $type = Auth::guard('account')->user()->acc_type;
        if ($type == 'investigator'){
            return redirect()->route('investigator.offensesmanagement')->with('delete', 'The record deleted successfully!'); 
        }
        elseif ($type == 'superadmin'){
            return redirect()->route('superadmin.offensesmanagement')->with('delete', 'The record deleted successfully!'); 
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
                return redirect()->back()->with('update', 'The record has been updated successfully!');
            }
    }

