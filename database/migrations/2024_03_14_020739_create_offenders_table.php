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
        Schema::create('offenders', function (Blueprint $table) {
            $table->id();
            $table->integer('comp_report_id');
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
            $table->string('offender_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offenders');
    }
};
