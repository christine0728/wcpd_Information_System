<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_report_author',
        'date_reported', 
        'place_of_commission',
        'offenses',
        'trafficking_in_person',
        'victim_firstname',
        'victim_family_name',
        'victim_middlename',
        'victim_aliases',
        'victim_sex',
        'victim_age',
        'victim_date_of_birth',
        'victim_place_of_birth',
        'victim_highest_educ_attainment',
        'victim_civil_status',
        'victim_nationality',
        'victim_present_address',
        'victim_provincial_address',
        'victim_parents_guardian_name',
        'victim_employment_info_occupation',
        'victim_docs_presented',
        'victim_contactperson_addr_con_num',
        'victim_image',
        'offender_firstname',
        'offender_family_name',
        'offender_middlename',
        'offender_sex',
        'offender_age',
        'offender_date_of_birth',
        'offender_civil_status',
        'offender_highest_educ_attainment',
        'offender_nationality',
        'offender_prev_criminal_rec',
        'offender_employment_info_occupation',
        'offender_last_known_addr',
        'offender_relationship_victim',
        'evidence_motive_cause',
        'evidence_influence_of',
        'case_disposition',
        'suspect_disposition',
        'investigator_on_case',
        'created_at',
        'updated_at',
        'case_update',
        'date_case_updated',
    ];
}
