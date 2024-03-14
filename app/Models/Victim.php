<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;

    protected $fillable = [
        'comp_report_id',
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
    ];
}
