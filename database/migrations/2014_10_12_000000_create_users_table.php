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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
             $table->string('role_member')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', [
                'admin',
                'Employee',
                'advisor_firm_Admin',
                'adviser',
                'oasis_sipp',
                'sipp_property',
                'full_sipp_property',
                'fpt',
            ])->default('adviser');  
            
            $table->text('adviser_check')->nullable();
            $table->text('oasis_sipp__check')->nullable();
            $table->text('sipp_property_check')->nullable();
            $table->text('full_sipp_check')->nullable();
            $table->text('ftp_check')->nullable();
            $table->text('illustration_check')->nullable();
            $table->text('member_details_check')->nullable();
            $table->text('leads_check')->nullable();
            $table->text('member_details_check')->nullable();
            $table->text('user_management_check')->nullable();
            $table->text('dms_check')->nullable();
            $table->text('reports_check')->nullable();
            $table->text('workflow_check')->nullable();
            $table->text('tickets_check')->nullable();
            $table->text('support_check')->nullable();
            $table->text('faq_check')->nullable();
            $table->text('communication_check')->nullable();
            $table->text('adviser_applications_check')->nullable();
            $table->text('member_applications_check')->nullable();
              
            $table->string('two_step_code')->nullable();
            $table->timestamp('two_step_expires_at')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            
          
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
