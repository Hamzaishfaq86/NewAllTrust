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
        Schema::create('offshores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('selected_adviser_id')->nullable();
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
            $table->text('appointed_representative_checked')->nullable();
            $table->text('principal_company_name')->nullable();
            $table->text('their_frn')->nullable();
            $table->text('advice')->nullable();
            $table->text('provide_countries')->nullable();
            $table->text('hear_about_us')->nullable();
            $table->text('word_of_referrals_checked')->nullable();
            $table->text('lead_generation_checked')->nullable();
            $table->text('marketing_checked')->nullable();
            $table->text('other_specify_checked')->nullable();
            $table->text('other_specify')->nullable();
            $table->text('other_money')->nullable();

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

            // Fee & Commission
            $table->text('initial_advice_fee')->nullable();
            $table->text('going_annual_fee')->nullable();
            $table->text('house_portfolio_solutions')->nullable();
            $table->text('receive_provider_commission')->nullable();

            // Investment Strategy
            $table->text('investment_strategy')->nullable();
            $table->text('typical_investment_strategy')->nullable();
            $table->text('running_managing_portfolios')->nullable();
            $table->text('basis')->nullable();
            $table->text('principal_company_name1')->nullable();
            $table->text('principal_company_name2')->nullable();
            $table->text('principal_company_name3')->nullable();
            $table->text('principal_company_name4')->nullable();

            // Bank Details
            $table->text('account_name')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('account_number')->nullable();
            $table->text('sort_code')->nullable();

            // DB Transfer
            $table->text('not_applicable')->nullable();
            $table->text('advisers_permitted')->nullable();
            $table->text('staff_supervisory_position')->nullable();
            $table->text('gold_standard')->nullable();
            $table->text('db_transfers_12_months')->nullable();
            $table->text('total_value_12_months')->nullable();
            $table->text('percentage_db_transfers_12_months')->nullable();
            $table->text('db_transfers_24_months')->nullable();
            $table->text('total_value_24_months')->nullable();
            $table->text('percentage_db_transfers_24_months')->nullable();
            $table->text('db_transfers_36_months')->nullable();
            $table->text('total_value_36_months')->nullable();
            $table->text('percentage_db_transfers_36_months')->nullable();
            $table->text('complaints_12_months')->nullable();
            $table->text('redress_cases_12_months')->nullable();
            $table->text('complaints_24_months')->nullable();
            $table->text('redress_cases_24_months')->nullable();
            $table->text('complaints_36_months')->nullable();
            $table->text('redress_cases_36_months')->nullable();
            $table->text('percentage_db_transfers')->nullable();
            $table->text('pension_specialist')->nullable();
            $table->text('act_as_specialist')->nullable();
            $table->text('details_of_firms')->nullable();
            $table->text('contact_name')->nullable();
            $table->text('email_address')->nullable();
            $table->text('phone_number')->nullable();
            $table->text('dial_code')->nullable();
            $table->text('minimum_cetv')->nullable();
            $table->text('conduct_db_transfers')->nullable();
            $table->text('accept_insistent_clients')->nullable();
            $table->text('work_with_unregulated_firms')->nullable();



            $table->text('receive_referrals')->nullable();
            $table->text('referral_details')->nullable();
            $table->text('db_transfer_percentage')->nullable();
            $table->text('db_client_source')->nullable();
            $table->text('relationships_with_trustees')->nullable();
            $table->text('trustee_relationship_details')->nullable();
            $table->text('contingent_charging')->nullable();
            $table->text('contingent_charging_details')->nullable();
            $table->text('triage_service')->nullable();
            $table->text('advice_fee')->nullable();
            $table->text('charging_structure_breakdown')->nullable();

            // Policies & Financial Crime
            $table->text('policies_coverage')->nullable();
            $table->text('not_covered_details')->nullable();
            $table->text('high_risk')->nullable();
            $table->text('standard_risk')->nullable();
            $table->text('low_risk')->nullable();
            $table->text('sensitive_jurisdictions')->nullable();
            $table->text('accept_peps')->nullable();
            $table->text('enhanced_due_diligence')->nullable();
            $table->text('add_details_text')->nullable();
            $table->text('collect_source')->nullable();
            $table->text('review_frequency')->nullable();

            // Non-Standard Assets
            $table->text('unregulated_firms')->nullable();
            $table->text('firms_details')->nullable();
            $table->text('total_business_percentage')->nullable();
            $table->text('investments_introduced')->nullable();
            $table->text('meet_client')->nullable();
            $table->text('business_conducted')->nullable();
            $table->text('knowledgeable_investors')->nullable();
            $table->text('criteria_details')->nullable();
            $table->text('products_design')->nullable();
            $table->text('fair_value')->nullable();
            $table->text('clear_communications')->nullable();
            $table->text('post_sales_support')->nullable();
            $table->text('customer_understanding')->nullable();

            // Agreement Section
            $table->string('signature_adviser')->nullable();
            $table->text('management_function')->nullable();
            $table->text('position_adviser')->nullable();
            $table->text('financial_adviser_number')->nullable();
            $table->text('date_column')->nullable();
            $table->text('signature_alltrust')->nullable();
            $table->text('position_alltrust')->nullable();
            $table->text('date_column2')->nullable();

            // CDD uploads =======

            $table->text('company_structure_chart')->nullable();
            $table->text('company_register_shareholder')->nullable();
            $table->text('company_authorised_signatory')->nullable();
            $table->text('appointed_text')->nullable();

            $table->text('advisers')->nullable();
            // Registered Adviser
            // $table->text('adviser_name')->nullable();
            // $table->text('adviser_fca_reference')->nullable();
            // $table->text('approved_for_transfer_db')->nullable();
            // $table->text('adviser_email')->nullable();
            // $table->text('branch')->nullable();
            // $table->text('requires_online_access')->nullable();
            $table->enum('status',['pending','active'])->default('pending');

            $table->timestamps();
            $table->softDeletes(); // Enable soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offshores');
    }
};
