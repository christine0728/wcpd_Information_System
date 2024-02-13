<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintReportController extends Controller
{
    public function add_complaint(Request $request){
        $currentUserId = Auth::guard('team')->user()->id;
        // dd($currentUserId);
        $comp_report = new ComplaintReport();

        $vic_date_birth = $request->input('vic_date_birth');
        $vic_age = Carbon::parse($vic_date_birth)->diffInYears(Carbon::now());

        $off_date_birth = $request->input('off_date_birth');
        $off_age = Carbon::parse($off_date_birth)->diffInYears(Carbon::now());
        // dd($off_age);

        $comp_report->complaint_report_author = $currentUserId; 
        $comp_report->date_reported = $request->input('datetime_commission');
        $comp_report->place_of_commission = $request->input('place_commission');
        $comp_report->offenses = $request->input('offenses');; 
        $comp_report->victim_firstname = $request->input('vic_firstname');
        $comp_report->victim_family_name = $request->input('vic_familyname');
        $comp_report->victim_middlename = $request->input('vic_middlename');
        $comp_report->victim_aliases = $request->input('vic_aliases');
        $comp_report->victim_sex = $request->input('vic_gender');

        $comp_report->victim_age = $vic_age;

        $comp_report->victim_date_of_birth = $request->input('vic_date_birth');
        $comp_report->victim_place_of_birth = $request->input('vic_place_birth');$comp_report->victim_highest_educ_attainment = $request->input('vic_educ_attainment'); 
        $comp_report->victim_civil_status = $request->input('vic_civil_stat');
        $comp_report->victim_nationality = $request->input('vic_citizenship');
        $comp_report->victim_present_address = $request->input('vic_present_addr');
        $comp_report->victim_provincial_address = $request->input('vic_prov_addr');
        $comp_report->victim_parents_guardian_name = $request->input('vic_parentsname');
        $comp_report->victim_employment_info_occupation = $request->input('vic_occupation');
        $comp_report->victim_docs_presented = $request->input('docs_presented');
        $comp_report->victim_contactperson_addr_con_num = $request->input('vic_contactperson');
        $comp_report->offender_firstname = $request->input('off_firstname');
        $comp_report->offender_family_name = $request->input('off_familyname');
        $comp_report->offender_middlename = $request->input('off_middlename');
        $comp_report->offender_aliases = $request->input('off_aliases');
        $comp_report->offender_sex = $request->input('off_gender');
        $comp_report->offender_age = $off_age;
        $comp_report->offender_date_of_birth = $request->input('off_date_birth');
        $comp_report->offender_civil_status = $request->input('off_civil_stat');
        $comp_report->offender_highest_educ_attainment = $request->input('off_educ_attainment');
        $comp_report->offender_nationality = $request->input('off_nationality');
        $comp_report->offender_prev_criminal_rec = $request->input('crim_rec_specify');
        $comp_report->offender_employment_info_occupation = $request->input('off_occupation');
        $comp_report->offender_last_known_addr = $request->input('off_last_addr');
        $comp_report->offender_relationship_victim = $request->input('rel_to_victim');
        $comp_report->evidence_motive_cause = $request->input('evi_motive');
        $comp_report->evidence_influence_of = $request->input('influences');
        $comp_report->case_disposition = $request->input('disposition');
        $comp_report->suspect_disposition = $request->input('sus_disposition');
        $comp_report->investigator_on_case = $request->input('investigator');
        $comp_report->created_at = Carbon::now();
        $comp_report->save();
        return redirect()->back()->with('message', 'The record has been added successfully!');
    }
}
