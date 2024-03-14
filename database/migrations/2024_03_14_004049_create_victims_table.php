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
        Schema::create('victims', function (Blueprint $table) {
            $table->id();
            $table->integer('comp_report_id'); 
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
            $table->string('victim_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victims');
    }
};
