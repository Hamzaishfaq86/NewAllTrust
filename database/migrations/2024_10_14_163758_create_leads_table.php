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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->text('company_name')->nullable();
            $table->text('trading_name')->nullable();
            $table->text('address')->nullable();
            $table->text('country')->nullable();
            $table->text('post_code')->nullable();
            $table->text('share_holder_details')->nullable();
            $table->text('regulated_adviser')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('website')->nullable();
            $table->text('telephone')->nullable();
            $table->text('fca_firms_reference')->nullable();
            $table->text('directly_authorised_checked')->nullable();
            $table->text('principal_company_name')->nullable();
            $table->text('their_frn')->nullable();
            $table->text('advice')->nullable();
            $table->text('provide_countries')->nullable();
            $table->text('hear_about_us')->nullable();
            $table->text('word_of_referrals_checked')->nullable();
            $table->text('lead_generation_checked')->nullable();
            $table->text('marketing_checked')->nullable();
            $table->text('other_specify_checked')->nullable();
            $table->text('restrictions_yes_permission')->nullable();
            $table->text('restrictions_yes_permission_answer')->nullable();
            $table->text('sanctions')->nullable();
            $table->text('sanctions_yes_answer')->nullable();
            $table->text('connection_connection')->nullable();
            $table->text('connection_connection_yes_answer')->nullable();
            $table->text('professional_indemnity_insurance')->nullable();
            $table->text('policy_excess_DB')->nullable();
            $table->text('separate_cyber_security')->nullable();
            $table->text('permissions_for_advising')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
