<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offender extends Model
{
    use HasFactory;

    protected $fillable = [
        'comp_report_id',
        'offender_firstname',
        'offender_family_name',
        'offender_middlename',
        'offender_aliases',
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
        'offender_image',
    ];
}
