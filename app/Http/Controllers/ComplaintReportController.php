<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Logs;
use App\Models\Offender;
use App\Models\Offense;
use App\Models\Victim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ComplaintReportController extends Controller
{
    public function add_complaint(Request $request){
        $currentUserId = Auth::guard('account')->user()->id; 

        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');

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
            'created_at' => $now,
            'updated_at' => $now,
            'case_update' => 'not update yet',
            'date_case_updated' => null
        ]);
        

        Validator::make($request->all(), [
            'input' => 'required|string', 
            'select1' => 'required',
            'select2' => 'required',
            'select3' => 'required',
            'select4' => 'required',
        ]);
 
        $acc_type = Auth::guard('account')->user()->acc_type;  

        $authorID = Auth::guard('account')->user()->id;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID; 
        $log->action = "Add";
        $log->details = "Added Complaint Report Form";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();
        
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.complaintreport')->with('success', 'Complaint Report Form added successfully!');
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.complaintreport')->with('success', 'Complaint Report Form added successfully!');
        }   
    }

    public function add_complaint1(Request $request){
        $currentUserId = Auth::guard('account')->user()->id; 

        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');   

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
 

        $validator = Validator::make($request->all(), [
            'datetime_commission' => 'required',
            'inv_case_no' => ['required', 'regex:/^[a-zA-Z0-9\-]+$/'],
            'place_commission' => ['required', 'regex:/^[a-zA-Z0-9\s\-_.,#]+$/'], 
            'offenses' => 'required', 
            'evi_motive' => 'required', 
            'influences' => 'required', 
            'disposition' => 'required', 
            'sus_disposition' => 'required', 
            'investigator' => ['required', 'regex:/^[a-zA-Z\s.]+$/'],   
        ], [
            'datetime_commission' => 'This field is required.',
            'inv_case_no.required' => 'This field is required.',
            'inv_case_no.regex' => 'This field must contain only letters, numbers, and dashes (-).',  
            'place_commission.required' => 'This field is required.',
            'place_commission.regex' => 'This field must contain only letters, numbers, # sign and periods.',  
            // 'place_commission' => 'This field is required.', 
            'offenses' => 'This field is required.', 
            'evi_motive' => 'This field is required.', 
            'influences' => 'This field is required.', 
            'disposition' => 'This field is required.', 
            'sus_disposition' => 'This field is required.', 
            'investigator.required' => 'This field is required.',
            'investigator.regex' => 'This field must contain only letters and periods.'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $offenses = $request->input('offenses');

        $serializedoffense = implode(', ', $offenses);

        // $rules=[
        //     'datetime_commission' => 'required', 
        // ];

        // $customMessages=[
        //     'required' => 'The :attribute field is empty.', 
        // ];

        // $this->validate($request, $rules, $customMessages);

        $comp = ComplaintReport::create([
            'complaint_report_author' => $currentUserId,
            'date_reported' => $request->input('datetime_commission'),
            'inv_case_no' => $request->input('inv_case_no'),
            'place_of_commission' => $request->input('place_commission'),
            'offenses' => $serializedoffense, 
            'evidence_motive_cause' => $request->input('evi_motive'),
            'evidence_influence_of' => $influence,
            'case_disposition' => $dispo,
            'suspect_disposition' => $sus_dispo,
            'investigator_on_case' => $request->input('investigator'),
            'created_at' => $now,
            'updated_at' => $now,
            'case_update' => 'not update yet',
            'date_case_updated' => null
        ]);

 
        $acc_type = Auth::guard('account')->user()->acc_type;  

        $authorID = Auth::guard('account')->user()->id;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID; 
        $log->action = "Add";
        $log->details = "Added Complaint Report Form";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();
        
        $comp_id = $comp->id;
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.victim_form', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!');
        }
        elseif ($acc_type == 'superadmin'){ 
            return redirect()->route('superadmin.victim_form', ['comp_id'=>$comp_id])->with('success', 'Complaint Report Form added successfully!'); 
        }   
    }

    public function view_complaintreport($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        $vics = Victim::where('comp_report_id', '=', $comp_id)->get();
        $offs = Offender::where('comp_report_id', '=', $comp_id)->get();

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_viewcomplaintreport1', ['comps' => $comps, 'comp_id'=>$comp_id, 'vics'=>$vics, 'offs'=>$offs]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_viewcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'vics'=>$vics, 'offs'=>$offs]); 
        }  
    }

    public function readonly_complaintreport($comp_id){
        $acc_type = Auth::guard('account')->user()->acc_type;
        $comps = ComplaintReport::select('*')
        ->where('id', $comp_id)
        ->get(); 

        $vics = Victim::where('comp_report_id', '=', $comp_id)->get();
        $offs = Offender::where('comp_report_id', '=', $comp_id)->get();

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'vics'=>$vics, 'offs'=>$offs]); 
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_readonlyreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'vics'=>$vics, 'offs'=>$offs]); 
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
        
        $vics = Victim::where('comp_report_id', '=', $comp_id)->get();
        $offs = Offender::where('comp_report_id', '=', $comp_id)->get();

        if ($acc_type == 'investigator'){
            return view('investigator.investigator_editcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'offenses'=>$offenses, 'vics'=>$vics, 'offs'=>$offs])->with('success', 'Complant Report Form added successfully!');
        }
        elseif ($acc_type == 'superadmin'){ 
            return view('superadmin.superadmin_editcomplaintreport', ['comps' => $comps, 'comp_id'=>$comp_id, 'offenses'=>$offenses, 'vics'=>$vics, 'offs'=>$offs])->with('success', 'Complant Report Form updated successfully!');; 
        } 
    }

    public function update_form(Request $request, $compid) {  
        $offenses = $request->input('offenses');

        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');

        $serializedoffense = implode(', ', $offenses);

        ComplaintReport::where('id', $compid)
            ->update([
                'inv_case_no' => $request->input('inv_case_no'),
                'offenses' => $serializedoffense, 
                'evidence_motive_cause' => $request->input('evi_motive'),
                'evidence_influence_of' => $request->input('influences'), 
                'updated_at' => $now,
            ]);

        $authorID = Auth::guard('account')->user()->id;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID; 
        $log->action = "Edit";
        $log->details = "Edited Complaint Report Form";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();

        $acc_type = Auth::guard('account')->user()->acc_type;
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.complaintreport')->with('updated', 'Complaint Report Form updated successfully!'); 
        }
        elseif ($acc_type == 'superadmin'){
            return redirect()->route('superadmin.complaintreport')->with('updated', 'Complaint Report Form updated successfully!');
        }
    }

    public function delete_form(Request $request, $compid) { 
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila'); 

        ComplaintReport::where('id', $compid)
        ->update([
            'status' => 'deleted', 
        ]);
            
        $acc_type = Auth::guard('account')->user()->acc_type;
        $authorID = Auth::guard('account')->user()->id;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID; 
        $log->action = "Delete";
        $log->details = "Deleted Complaint Report Form";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();
        
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.complaintreport')->with('delete', 'Complaint Report Form deleted successfully!'); 
        }
        elseif ($acc_type == 'superadmin'){
            return redirect()->route('superadmin.complaintreport')->with('delete', 'Complaint Report Form deleted successfully!');
        } 
    }

    public function restore_form(Request $request, $compid) { 
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila'); 

        ComplaintReport::where('id', $compid)
            ->update([
                'status' => 'notdeleted', 
            ]);
            
        $acc_type = Auth::guard('account')->user()->acc_type;
        $authorID = Auth::guard('account')->user()->id;
        $log = new Logs();
        $log->author_type = Auth::guard('account')->user()->acc_type;
        $log->author_id = $authorID; 
        $log->action = "Restore";
        $log->details = "Restored Complaint Report Form";
        $log->created_at = $now;
        $log->updated_at = $now;
        $log->save();
        
        if ($acc_type == 'investigator'){
            return redirect()->route('investigator.trash')->with('delete', 'Complaint Report Form deleted successfully!'); 
        }
        elseif ($acc_type == 'superadmin'){
            return redirect()->route('superadmin.trash')->with('delete', 'Complaint Report Form deleted successfully!');
        } 
    }

    public function permanent_del(string $id){
        $book = ComplaintReport::find($id);
        $book->delete();
        return redirect()->back()->with('delete', 'Complaint Report Form deleted permanently!');
    }
}
