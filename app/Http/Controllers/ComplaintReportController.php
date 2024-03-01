<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Offense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ComplaintReportController extends Controller
{
    public function add_complaint(Request $request){
        $currentUserId = Auth::guard('account')->user()->id; 

        // $request->validate([
        //     'input' => 'required|regex:/^[a-zA-Z0-9]*$/',
        // ]);

        $vic_date_birth = $request->input('vic_date_birth');

        $vic_age = Carbon::parse($vic_date_birth)->diffInYears(Carbon::now());

        $off_date_birth = $request->input('off_date_birth');
        $off_age = Carbon::parse($off_date_birth)->diffInYears(Carbon::now()); 

        $offenses = $request->input('offenses');

        $serializedoffense = implode(', ', $offenses);

        $v_educ_attain = $request->input('vic_educ_attainment');

        if ($v_educ_attain == "Others"){
            $v_educ_attain = $request->input('others');
        }
        else {
            $v_educ_attain = $request->input('vic_educ_attainment');
        }

        $o_educ_attain = $request->input('off_educ_attainment');
        if ($o_educ_attain == "Others2"){
            $o_educ_attain = $request->input('others2');
        }
        else {
            $o_educ_attain = $request->input('off_educ_attainment');
        }

        $influence = $request->input('influences');
        if ($influence == "Others3"){
            $influence = $request->input('others3');
        }
        else {
            $influence = $request->input('influences');
        }

        $dispo = $request->input('disposition');
        if ($dispo == "Others4"){
            $dispo = $request->input('others4');
        }
        else {
            $dispo = $request->input('disposition');
        }

        $sus_dispo = $request->input('sus_disposition');
        if ($sus_dispo == "Others5"){
            $sus_dispo = $request->input('others5');
        }
        else {
            $sus_dispo = $request->input('sus_disposition');
        }

        if ($request->hasFile('vic_image')) {
            $vic_file = $request->file('vic_image');
            $vic_extension = $vic_file->getClientOriginalExtension();
            $vic_filename = time() . '.' . $vic_extension;
            $vic_file->move('images/victims/', $vic_filename);
        } else {
            $vic_filename = 'no image';
        }
        
        if ($request->hasFile('off_image')) {
            $off_file = $request->file('off_image');
            $off_extension = $off_file->getClientOriginalExtension();
            $off_filename = time() . '.' . $off_extension;
            $off_file->move('images/offenders/', $off_filename);
        } else {
            $off_filename = 'no image';
        }

        $user = ComplaintReport::create([
            'complaint_report_author' => $currentUserId,
            'date_reported' => $request->input('datetime_commission'),
            'place_of_commission' => $request->input('place_commission'),
            'offenses' => $serializedoffense, 
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
            'evidence_motive_cause' => $request->input('evi_motive'),
            'evidence_influence_of' => $influence,
            'case_disposition' => $dispo,
            'suspect_disposition' => $sus_dispo,
            'investigator_on_case' => $request->input('investigator'),
            'created_at' => Carbon::now(),
        ]);
        

        Validator::make($request->all(), [
            'input' => 'required|string', // Example validation rule, adjust as needed
        ]);

        $author_id = Auth::guard('account')->user()->id;
        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
            ->select('accounts.id as accountid', 'accounts.username', 'complaint_reports.id', 'complaint_reports.complaint_report_author', 'complaint_reports.date_reported', 'complaint_reports.place_of_commission', 'complaint_reports.offenses', 'complaint_reports.victim_family_name', 'complaint_reports.victim_firstname', 'complaint_reports.victim_middlename', 'complaint_reports.victim_sex', 'complaint_reports.victim_age', 'complaint_reports.victim_docs_presented', 'complaint_reports.offender_firstname', 'complaint_reports.offender_family_name', 'complaint_reports.offender_middlename', 'complaint_reports.offender_sex', 'complaint_reports.offender_age', 'complaint_reports.offender_relationship_victim', 'complaint_reports.evidence_motive_cause', 'complaint_reports.case_disposition', 'complaint_reports.suspect_disposition')->where('complaint_report_author', '=', $author_id)
        ->get();
        // return view('investigator.investigator_complaintreportmngt', ['comps'=>$comps]);
        return redirect()->route('investigator.complaintreport')->with('message', 'record updated successfully');
    }

    public function view_complaintreport($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_viewcomplaintreport1', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_viewcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }  
    }

    public function readonly_complaintreport($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id]); 
        }  
    }

    public function edit_complaintreport($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;

        $comps = ComplaintReport::select('*')
            ->where('id', $comp_id)
            ->get(); 

        $offenses = Offense::select('*') 
            ->where('not_delete', '=', false)
            ->get();
        
        if ($acc_type == 'investigator'){
            return view('investigator.investigator_editcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'offenses'=>$offenses]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_editcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'offenses'=>$offenses]); 
        } 
    }

    public function update_form(Request $request, $compid) {  
        $offenses = $request->input('offenses');

        $serializedoffense = implode(', ', $offenses);

        ComplaintReport::where('id', $compid)
            ->update([
                'offenses' => $serializedoffense,
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

        $acc_type = Auth::guard('account')->user()->acc_type;
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.complaintreport')->with('message', 'record updated successfully'); 
        }
        elseif ($acc_type == 'superadmin'){
            return redirect()->route('superadmin.complaintreport')->with('message', 'record updated successfully');
        }
    }

    public function delete_form(Request $request, $compid) {  
        ComplaintReport::where('id', $compid)
            ->update([
                'status' => 'deleted', 
            ]);
            
        $acc_type = Auth::guard('account')->user()->acc_type;
        
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.complaintreport')->with('message', 'record updated successfully'); 
        }
        elseif ($acc_type == 'superadmin'){
            return redirect()->route('superadmin.complaintreport')->with('message', 'record updated successfully');
        } 
    }
}
