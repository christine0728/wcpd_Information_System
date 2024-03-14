<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Notifications;
use App\Models\Victim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VictimController extends Controller
{
    public function victim_form($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
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
            return view('investigator.investigator_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.victim_form', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!'); 
        }  
    }

    public function edit_victim($vid)
    { 
        $comps = Victim::  
            where('id', '=', $vid)
            ->get();
        $notifs = Notifications::where('status', '=', 'unread')
            ->count();
        return view('superadmin.superadmin_editvictimprofile', ['comps'=>$comps, 'notifs'=>$notifs, 'vid'=>$vid]);
    }

    public function update_victim(Request $request, $vid){
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

        return redirect()->route('superadmin.victim_profile', ['vid'=>$vid])->with('success', 'Complaint Report Form added successfully!'); 
    }
}
