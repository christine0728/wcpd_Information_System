<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Notifications;
use App\Models\Offender;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffenderController extends Controller
{
    public function edit_offender($oid)
    { 
        $comps = Offender::  
            where('id', '=', $oid)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_editoffenderprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'oid'=>$oid]);
    }

    public function update_offender(Request $request, $oid){
        $acc_type = Auth::guard('account')->user()->acc_type; 

        // dd($comp_id);
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');

        $off_date_birth = $request->input('off_date_birth');
        $off_age = Carbon::parse($off_date_birth)->diffInYears(Carbon::now());

        if ($request->hasFile('off_image')) {
            $off_file = $request->file('off_image');
            $off_extension = $off_file->getClientOriginalExtension();
            $off_filename = time() . '.' . $off_extension;
            $off_file->move('images/offenders/', $off_filename);
        } else {
            $off_filename = 'no image';
        }

        $o_educ_attain = $request->input('off_educ_attainment');
        if ($o_educ_attain == "Others"){
            $o_educ_attain = $request->input('others');
        }
        else {
            $o_educ_attain = $request->input('off_educ_attainment');
        }

        if ($request->hasFile('off_image')) {
            $off_file = $request->file('off_image');
            $off_extension = $off_file->getClientOriginalExtension();
            $off_filename = time() . '.' . $off_extension;
            $off_file->move('images/offenders/', $off_filename);
        } else {
            $off_filename = 'no image';
        }

        $off_date_birth = $request->input('off_date_birth');
        $off_age = Carbon::parse($off_date_birth)->diffInYears(Carbon::now()); 
            // dd($comp_id);
        $user = Offender::where('id', $oid)
        ->update([  
            'offender_firstname' => $request->input('off_firstname'),
            'offender_family_name' => $request->input('off_familyname'),
            'offender_middlename' => $request->input('off_middlename'),
            'offender_aliases' => $request->input('off_aliases'),
            'offender_sex' => $request->input('off_gender'),
            'offender_age' => $off_age,
            'offender_date_of_birth' => $request->input('off_date_birth'),
            'offender_civil_status' => $request->input('off_civil_stat'),
            'offender_highest_educ_attainment' => $o_educ_attain,
            'offender_nationality' => $request->input('off_nationality'),
            'offender_prev_criminal_rec' => $request->input('crim_rec_specify'),
            'offender_employment_info_occupation' => $request->input('off_occupation'),
            'offender_last_known_addr' => $request->input('off_last_addr'),
            'offender_relationship_victim' => $request->input('rel_to_victim'),
            'offender_image' => $off_filename,
            'created_at' => $now,
            'updated_at' => $now, 
        ]);

        if ($acc_type == 'investigator'){
            // return view('investigator.investigator_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.offender_profile', [$oid])->with('success', 'Complaint Report Form added successfully!'); 
        }   
    }
}
