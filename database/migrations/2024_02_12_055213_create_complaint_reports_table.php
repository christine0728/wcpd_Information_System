<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaint_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('complaint_report_author'); 
            $table->date('date_reported'); 
            $table->string('place_of_commission'); 
            $table->string('offenses'); 
            $table->string('trafficking_in_person'); 
            $table->string('victim_firstname'); 
            $table->string('victim_family_name'); 
            $table->string('victim_middlename'); 
            $table->string('victim_aliases'); 
            $table->string('victim_sex'); 
            $table->integer('victim_age'); 
            $table->date('victim_date_of_birth'); 
            $table->string('victim_place_of_birth'); 
            $table->string('victim_highest_educ_attainment'); 
            $table->string('victim_civil_status'); 
            $table->string('victim_nationality'); 
            $table->string('victim_present_address'); 
            $table->string('victim_provincial_address'); 
            $table->string('victim_parents_guardian_name'); 
            $table->string('victim_employment_info_occupation'); 
            $table->string('victim_docs_presented'); 
            $table->text('victim_contactperson_addr_con_num'); 
            $table->string('offender_firstname'); 
            $table->string('offender_family_name'); 
            $table->string('offender_middlename'); 
            $table->string('offender_aliases'); 
            $table->string('offender_sex'); 
            $table->integer('offender_age'); 
            $table->date('offender_date_of_birth'); 
            $table->string('offender_civil_status'); 
            $table->string('offender_highest_educ_attainment'); 
            $table->string('offender_nationality'); 
            $table->string('offender_prev_criminal_rec'); 
            $table->string('offender_employment_info_occupation'); 
            $table->string('offender_last_known_addr'); 
            $table->string('offender_relationship_victim'); 
            $table->string('evidence_motive_cause'); 
            $table->string('evidence_influence_of'); 
            $table->string('case_disposition'); 
            $table->string('suspect_disposition'); 
            $table->string('investigator_on_case'); 
            $table->timestamp('created_at'); 
            $table->timestamp('updated_at')->nullable();; 
            $table->string('case_update'); 
            $table->string('date_case_updated'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_reports');
    }
};
