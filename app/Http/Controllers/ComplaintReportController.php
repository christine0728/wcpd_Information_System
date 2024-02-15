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
        // return redirect()->back()->with('message', 'The record has been added successfully!');

        $author_id = Auth::guard('team')->user()->id;
        $comps = ComplaintReport::join('teams', 'teams.id', '=', 'complaint_reports.complaint_report_author')
        ->select('teams.id as teamid', 'teams.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')->where('complaint_report_author', $author_id)
        ->get();
        // return view('team.team_complaintreportmngt', ['comps'=>$comps]);
        return redirect()->route('team.complaintreport')->with('message', 'record updated successfully');
    }

    public function view_complaintreport($comp_id){
        $comps = ComplaintReport::select('*')
            ->where('id', $comp_id)
            ->get(); 
        
        return view('team.team_viewcomplaintreport1', ['comps' => $comps, 'comp_id'=>$comp_id]); 
    }

    public function edit_complaintreport($comp_id){
        $comps = ComplaintReport::select('*')
            ->where('id', $comp_id)
            ->get(); 
        
        return view('team.team_editcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
    }

    public function update_form(Request $request, $compid) {  
        ComplaintReport::where('id', $compid)
            ->update([
                'offenses' => $request->input('offenses'),
                'victim_family_name' => $request->input('vic_familyname'),
                'victim_firstname' => $request->input('vic_firstname'),
                'victim_middlename' => $request->input('vic_middlename'),
                'victim_aliases' => $request->input('vic_aliases'),
                'victim_sex' => $request->input('vic_gender'),
                'victim_date_of_birth' => $request->input('vic_date_birth'),
                'victim_place_of_birth' => $request->input('vic_place_birth'), 
                'victim_highest_educ_attainment' => $request->input('vic_educ_attainment'),
                'victim_civil_status' => $request->input('vic_civil_stat'),
                'victim_nationality' => $request->input('vic_citizenship'),
                'victim_present_address' => $request->input('vic_present_addr'),
                'victim_provincial_address' => $request->input('vic_prov_addr'),
                'victim_parents_guardian_name' => $request->input('vic_parentsname'),
                'victim_place_of_birth' => $request->input('vic_place_birth'),
                'victim_place_of_birth' => $request->input('vic_place_birth'),
                'victim_employment_info_occupation' => $request->input('vic_occupation'),
                'victim_docs_presented' => $request->input('docs_presented'),
                'victim_contactperson_addr_con_num' => $request->input('vic_contactperson'),
                'offender_family_name' => $request->input('off_familyname'),
                'offender_firstname' => $request->input('off_firstname'),
                'offender_middlename' => $request->input('off_middlename'),
                'offender_aliases' => $request->input('off_aliases'),
                'victim_docs_presented' => $request->input('docs_presented'),
                'offender_sex' => $request->input('off_gender'),
                'offender_date_of_birth' => $request->input('off_date_birth'),
                'offender_civil_status' => $request->input('off_civil_stat'),
                'offender_highest_educ_attainment' => $request->input('off_educ_attainment'),
                'offender_nationality' => $request->input('off_nationality'), 
                'offender_prev_criminal_rec' => $request->input('crim_rec_specify'),
                'offender_employment_info_occupation' => $request->input('off_occupation'),
                'offender_relationship_victim' => $request->input('rel_to_victim'),
                'evidence_motive_cause' => $request->input('evi_motive'),
                'evidence_influence_of' => $request->input('influences'),
                'offender_nationality' => $request->input('off_nationality'),
                'offender_nationality' => $request->input('off_nationality'),
                'offender_nationality' => $request->input('off_nationality'),
            ]);

        return redirect()->route('team.complaintreport')->with('message', 'record updated successfully'); 
    }

    public function delete_form(Request $request, $compid) {  
        ComplaintReport::where('id', $compid)
            ->update([
                'status' => 'deleted', 
            ]);

        return redirect()->route('team.complaintreport')->with('message', 'record updated successfully'); 
    }
}
