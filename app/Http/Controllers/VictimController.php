<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Notifications;
use App\Models\Victim;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VictimController extends Controller
{
    public function victim_form($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_victimform', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_victimform', ['comp_id'=>$comp_id]);
        }  
    }

    public function insert_victim(Request $request, $comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        // dd($comp_id);
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');


        $vic_date_birth = $request->input('vic_date_birth');
        $vic_age = Carbon::parse($vic_date_birth)->diffInYears(Carbon::now());

        if ($request->hasFile('vic_image')) {
            $vic_file = $request->file('vic_image');
            $vic_extension = $vic_file->getClientOriginalExtension();
            $vic_filename = time() . '.' . $vic_extension;
            $vic_file->move('images/victims/', $vic_filename);
        } else {
            $vic_filename = 'no image';
        }

        $v_educ_attain = $request->input('vic_educ_attainment');
        if ($v_educ_attain == "Others"){
            $v_educ_attain = $request->input('others');
        }
        else {
            $v_educ_attain = $request->input('vic_educ_attainment');
        } 

        // dd($comp_id);

        $validator = Validator::make($request->all(), [
            'vic_familyname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'vic_firstname' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'vic_middlename' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'vic_aliases' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'vic_gender' => 'required', 
            'vic_date_birth' => 'required', 
            'vic_place_birth' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'], 
            'vic_educ_attainment' => 'required', 
            'vic_civil_stat' => 'required', 
            'vic_citizenship' => ['required', 'regex:/^[a-zA-Z]+$/'], 
            'vic_present_addr' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'],
            'vic_prov_addr' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'], 
            'vic_parentsname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'vic_occupation' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'docs_presented' => ['required', 'regex:/^[a-zA-Z,\s]+$/'],
            'vic_contactperson' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'],
            'vic_present_addr' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'], 
        ], [
            'vic_familyname.required' => 'This field is required.',
            'vic_familyname.regex' => 'This field must contain letters only.', 
            'vic_firstname.required' => 'This field is required.',
            'vic_firstname.regex' => 'This field must contain letters only.', 
            'vic_middlename.required' => 'This field is required.',
            'vic_middlename.regex' => 'This field must contain letters only.',  
            'vic_aliases' => 'This field is empty.', 
            'vic_gender' => 'This field is empty.', 
            'vic_date_birth' => 'This field is empty.', 
            'vic_place_birth.required' => 'This field is required.',
            'vic_place_birth.regex' => 'This field must contain only letters, numbers, # sign and periods.',   
            'vic_educ_attainment' => 'This field is empty.', 
            'vic_civil_stat' => 'This field is empty.', 
            'vic_citizenship.required' => 'This field is required.',
            'vic_citizenship.regex' => 'This field must contain letters only.',
            'vic_present_addr.required' => 'This field is required.',
            'vic_present_addr.regex' => 'This field must contain only letters, numbers, # sign and periods.', 
            'vic_prov_addr.required' => 'This field is required.',
            'vic_prov_addr.regex' => 'This field must contain only letters, numbers, # sign and periods.',  
            'vic_parentsname.required' => 'This field is required.',
            'vic_parentsname.regex' => 'This field must contain letters only.',
            'vic_occupation.required' => 'This field is required.',
            'vic_occupation.regex' => 'This field must contain letters only.',
            'docs_presented.required' => 'This field is required.',
            'docs_presented.regex' => 'This field must contain letters and commas only.',
            'vic_contactperson.required' => 'This field is required.',
            'vic_contactperson.regex' => 'This field must contain only letters, numbers, # sign and periods.',  
            'vic_present_addr.required' => 'This field is required.',
            'vic_present_addr.regex' => 'This field must contain only letters, numbers, # sign and periods.',  
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Victim::create([ 
            'comp_report_id' => $comp_id,
            'victim_firstname' => $request->input('vic_firstname'),
            'victim_family_name' => $request->input('vic_familyname'),
            'victim_middlename' => $request->input('vic_middlename'),
            'victim_aliases' => $request->input('vic_aliases'),
            'victim_sex' => $request->input('vic_gender'),
            'victim_age' => $vic_age,
            'victim_date_of_birth' => $request->input('vic_date_birth'),
            'victim_place_of_birth' => $request->input('vic_place_birth'),'victim_highest_educ_attainment' => $v_educ_attain, 
            'victim_civil_status' => $request->input('vic_civil_stat'),
            'victim_nationality' => $request->input('vic_citizenship'),
            'victim_present_address' => $request->input('vic_present_addr'),
            'victim_provincial_address' => $request->input('vic_prov_addr'),
            'victim_parents_guardian_name' => $request->input('vic_parentsname'),
            'victim_employment_info_occupation' => $request->input('vic_occupation'),
            'victim_docs_presented' => $request->input('docs_presented'),
            'victim_contactperson_addr_con_num' => $request->input('vic_contactperson'),
            'victim_image' => $vic_filename,
            'created_at' => $now,
            'updated_at' => $now, 
        ]);
 

        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.victim_form', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!'); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.victim_form', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!'); 
        }  
    }

    public function edit_victim($vid)
    { 
        $acc_type = Auth::guard('account')->user()->acc_type;

        $comps = Victim::  
            where('id', '=', $vid)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
         
        if ($acc_type == 'investigator'){
            return view('investigator.investigator_editvictimprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'vid'=>$vid]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_editvictimprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'vid'=>$vid]);
        }
        // return view('superadmin.superadmin_editvictimprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'vid'=>$vid]);
    }

    public function update_victim(Request $request, $vid){
        $acc_type = Auth::guard('account')->user()->acc_type;

        $vic_date_birth = $request->input('vic_date_birth');
        $vic_age = Carbon::parse($vic_date_birth)->diffInYears(Carbon::now());

        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
 
        if ($request->hasFile('vic_image')) {
            $vic_file = $request->file('vic_image');
            $vic_extension = $vic_file->getClientOriginalExtension();
            $vic_filename = time() . '.' . $vic_extension;
            $vic_file->move('images/victims/', $vic_filename);
        } else {
            $vic_filename = 'no image';
        }

        $v_educ_attain = $request->input('vic_educ_attainment');
        if ($v_educ_attain == "Others"){
            $v_educ_attain = $request->input('others');
        }
        else {
            $v_educ_attain = $request->input('vic_educ_attainment');
        }

        Victim::where('id', $vid)
        ->update([ 
            'victim_firstname' => $request->input('vic_firstname'),
            'victim_family_name' => $request->input('vic_familyname'),
            'victim_middlename' => $request->input('vic_middlename'),
            'victim_aliases' => $request->input('vic_aliases'),
            'victim_sex' => $request->input('vic_gender'),
            'victim_age' => $vic_age,
            'victim_date_of_birth' => $request->input('vic_date_birth'),
            'victim_place_of_birth' => $request->input('vic_place_birth'),'victim_highest_educ_attainment' => $v_educ_attain, 
            'victim_civil_status' => $request->input('vic_civil_stat'),
            'victim_nationality' => $request->input('vic_citizenship'),
            'victim_present_address' => $request->input('vic_present_addr'),
            'victim_provincial_address' => $request->input('vic_prov_addr'),
            'victim_parents_guardian_name' => $request->input('vic_parentsname'),
            'victim_employment_info_occupation' => $request->input('vic_occupation'),
            'victim_docs_presented' => $request->input('docs_presented'),
            'victim_contactperson_addr_con_num' => $request->input('vic_contactperson'),
            'victim_image' => $vic_filename, 
            'updated_at' => $now, 
        ]);

        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.victim_profile', ['vid'=>$vid])->with('success', 'Complaint Report Form added successfully!');  
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.victim_profile', ['vid'=>$vid])->with('success', 'Complaint Report Form added successfully!'); 
        }

        // return redirect()->route('superadmin.victim_profile', ['vid'=>$vid])->with('success', 'Complaint Report Form added successfully!'); 
    }
}
