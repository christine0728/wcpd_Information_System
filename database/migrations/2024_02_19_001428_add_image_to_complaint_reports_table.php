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
        Schema::table('complaint_reports', function (Blueprint $table) {
            $table->string('victim_image')->default('no image')->after('victim_contactperson_addr_con_num');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_reports', function (Blueprint $table) {
            //
        });
    }
};
