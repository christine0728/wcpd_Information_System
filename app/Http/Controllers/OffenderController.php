<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Notifications;
use App\Models\Offender;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OffenderController extends Controller
{
    public function offender_form(Request $request, $comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 
        
        if ($acc_type == 'investigator'){
            return view('investigator.investigator_offenderform', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_offenderform', ['comp_id'=>$comp_id]);
        }  
    }

    public function insert_offender(Request $request, $comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');

        $vic_date_birth = $request->input('vic_date_birth');
        $vic_age = Carbon::parse($vic_date_birth)->diffInYears(Carbon::now());

        if ($request->hasFile('vic_image')) {
            $vic_file = $request->file('vic_image');
            $vic_extension = $vic_file->getClientOriginalExtension();
            $vic_filename = time() . '.' . $vic_extension;
            $vic_file->move('images/offenders/', $vic_filename);
        } else {
            $vic_filename = 'no image';
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

        $validator = Validator::make($request->all(), [
            'off_familyname' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'off_firstname' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'off_middlename' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'off_aliases' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'off_gender' => 'required', 
            'off_date_birth' => 'required', 
            'off_place_birth' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'],
            'off_educ_attainment' => 'required', 
            'off_civil_stat' => 'required', 
            'off_nationality' => ['required', 'regex:/^[a-zA-Z]+$/'],  
            'off_occupation' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'off_last_addr' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'],
            'rel_to_victim' => ['required', 'regex:/^[a-zA-Z]+$/'], 
        ], [
            'off_familyname.required' => 'This field is required.',
            'off_familyname.regex' => 'This field must contain letters only.',
            'off_firstname.required' => 'This field is required.',
            'off_firstname.regex' => 'This field must contain letters only.', 
            'off_middlename.required' => 'This field is required.',
            'off_middlename.regex' => 'This field must contain letters only.',  
            'off_aliases.required' => 'This field is required.',
            'off_aliases.regex' => 'This field must contain letters only.',
            'off_gender' => 'This field is empty', 
            'off_date_birth' => 'This field is empty', 
            'off_place_birth.required' => 'This field is required.',
            'off_place_birth.regex' => 'This field must contain only letters, numbers, # sign and periods.', 
            'off_educ_attainment' => 'This field is empty', 
            'off_civil_stat' => 'This field is empty', 
            'off_nationality.required' => 'This field is required.',
            'off_nationality.regex' => 'This field must contain letters only.',  
            'off_occupation.required' => 'This field is required.',
            'off_occupation.regex' => 'This field must contain letters only.', 
            'off_last_addr.required' => 'This field is required.',
            'off_last_addr.regex' => 'This field must contain only letters, numbers, # sign and periods.',
            'rel_to_victim.required' => 'This field is required.',
            'rel_to_victim.regex' => 'This field must contain letters only.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Offender::create([ 
            'comp_report_id' => $comp_id,
            'offender_firstname' => $request->input('off_firstname'),
            'offender_family_name' => $request->input('off_familyname'),
            'offender_middlename' => $request->input('off_middlename'),
            'offender_aliases' => $request->input('off_aliases'),
            'offender_sex' => $request->input('off_gender'),
            'offender_age' => $off_age,
            'offender_date_of_birth' => $request->input('off_date_birth'),
            'offender_place_of_birth' => $request->input('off_place_birth'),
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
            return redirect()->route('investigator.edit_complaintreport', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!'); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.edit_complaintreport', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!'); 
        }   
    }

    public function edit_offender($oid)
    { 
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = Offender::  
            where('id', '=', $oid)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_editoffenderprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'oid'=>$oid]);
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_editoffenderprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'oid'=>$oid]);
        }
        
        // return view('superadmin.superadmin_editoffenderprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'oid'=>$oid]);
    }

    public function update_offender(Request $request, $oid){
        $acc_type = Auth::guard('account')->user()->acc_type; 
        $image = $request->file('image');
     
        // dd($comp_id);
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        $ii= $request->input('off_image_inp');
 
        $off_date_birth = $request->input('off_date_birth');
        $off_age = Carbon::parse($off_date_birth)->diffInYears(Carbon::now());

        if ($request->hasFile('off_image')) {
            $off_file = $request->file('off_image');
            $off_extension = $off_file->getClientOriginalExtension();
            $off_filename = time() . '.' . $off_extension;
            $off_file->move('images/offenders/', $off_filename);
        } else { 
            $off_filename = $request->input('off_image_inp');
        }

        $o_educ_attain = $request->input('off_educ_attainment');
        if ($o_educ_attain == "Others"){
            $o_educ_attain = $request->input('others');
        }
        else {
            $o_educ_attain = $request->input('off_educ_attainment');
        }
  
        $off_date_birth = $request->input('off_date_birth');
        $off_age = Carbon::parse($off_date_birth)->diffInYears(Carbon::now()); 
            // dd($comp_id);
 
            $validator = Validator::make($request->all(), [
                'off_familyname' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
                'off_firstname' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
                'off_middlename' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
                'off_aliases' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
                'off_date_birth' => 'required', 
                'off_place_birth' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'], 
                'off_educ_attainment' => 'required',  
                'off_nationality' => ['required', 'regex:/^[a-zA-Z]+$/'],  
                'off_occupation' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
                'off_last_addr' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'],
                'rel_to_victim' => ['required', 'regex:/^[a-zA-Z]+$/'], 
            ], [
                'off_familyname.required' => 'This field is required.',
                'off_familyname.regex' => 'This field must contain letters only.',
                'off_firstname.required' => 'This field is required.',
                'off_firstname.regex' => 'This field must contain letters only.', 
                'off_middlename.required' => 'This field is required.',
                'off_middlename.regex' => 'This field must contain letters only.',  
                'off_aliases.required' => 'This field is required.',
                'off_aliases.regex' => 'This field must contain letters only.',
                // 'off_gender' => 'This field is empty', 
                'off_date_birth' => 'This field is empty', 
                'off_place_birth.required' => 'This field is required.',
                'off_place_birth.regex' => 'This field must contain only letters, numbers, # sign and periods.',  
                'off_educ_attainment' => 'This field is empty', 
                // 'off_civil_stat' => 'This field is empty', 
                'off_nationality.required' => 'This field is required.',
                'off_nationality.regex' => 'This field must contain letters only.',  
                'off_occupation.required' => 'This field is required.',
                'off_occupation.regex' => 'This field must contain letters only.', 
                'off_last_addr.required' => 'This field is required.',
                'off_last_addr.regex' => 'This field must contain only letters, numbers, # sign and periods.',
                'rel_to_victim.required' => 'This field is required.',
                'rel_to_victim.regex' => 'This field must contain letters only.',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            
        $user = Offender::where('id', $oid)
        ->update([  
            'offender_firstname' => $request->input('off_firstname'),
            'offender_family_name' => $request->input('off_familyname'),
            'offender_middlename' => $request->input('off_middlename'),
            'offender_aliases' => $request->input('off_aliases'), 
            'offender_age' => $off_age,
            'offender_date_of_birth' => $request->input('off_date_birth'), 
            'offender_place_of_birth' => $request->input('off_place_birth'),
            'offender_highest_educ_attainment' => $o_educ_attain,
            'offender_nationality' => $request->input('off_nationality'),
            'offender_prev_criminal_rec' => $request->input('crim_rec_specify'),
            'offender_employment_info_occupation' => $request->input('off_occupation'),
            'offender_last_known_addr' => $request->input('off_last_addr'),
            'offender_relationship_victim' => $request->input('rel_to_victim'),
            'offender_image' => $off_filename, 
            'updated_at' => $now, 
        ]);

        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.offender_profile', [$oid])->with('success', 'Complaint Report Form added successfully!'); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.offender_profile', [$oid])->with('success', 'Complaint Report Form added successfully!'); 
        }   
    }
}
