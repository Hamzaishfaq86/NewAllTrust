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
        Schema::create('fpts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('scheme_name')->nullable();
            $table->text('contact_name')->nullable();
            $table->text('company_name')->nullable();
            $table->text('address')->nullable();
            $table->text('country')->nullable();
            $table->text('post_code')->nullable();
            $table->text('dial_code')->nullable();
            $table->text('phone_number')->nullable();
            $table->text('email')->nullable();
            $table->text('regulated_by')->nullable();
            $table->text('auth_number')->nullable();
            $table->text('initial_fee')->nullable();
            $table->text('scheme_establishment')->nullable();
            $table->text('date_option')->nullable();
            $table->text('date_day')->nullable();
            $table->text('date_month')->nullable();
            $table->text('date_year')->nullable();
            $table->text('annual_fee')->nullable();
            $table->text('scheme_anniversary')->nullable();
            $table->text('date_option2')->nullable();
            $table->text('date2_day')->nullable();
            $table->text('date2_month')->nullable();
            $table->text('date2_year')->nullable();
            $table->text('percentage_checkbox')->nullable();
            $table->text('percentage')->nullable();
            $table->text('specific_investments_checkbox')->nullable();
            $table->text('specific_investments_list')->nullable();
            $table->text('initial_fee_amount1')->nullable();
            $table->text('initial_fee_percentage1')->nullable();
            $table->text('scheme_establishment_alternative1')->nullable();
            $table->text('date_alternative1')->nullable();
            $table->text('date_alt_day1')->nullable();
            $table->text('date_alt_month1')->nullable();
            $table->text('date_alt_year1')->nullable();
            $table->text('scheme_anniversary_alternative1')->nullable();
            $table->text('transfer_amount_checkbox1')->nullable();
            $table->text('transfer_amount_value1')->nullable();
            $table->text('percentage_checkbox_transfer1')->nullable();
            $table->text('transfer_percentage_value1')->nullable();
            $table->text('transfer_payment1')->nullable();
            $table->text('future_terms1')->nullable();
            $table->text('print_name_left1')->nullable();
            $table->text('signature_left1')->nullable();
            $table->text('date_signed_left_day1')->nullable();
            $table->text('date_signed_left_month1')->nullable();
            $table->text('date_signed_left_year1')->nullable();
            $table->text('print_name_right1')->nullable();
            $table->text('signature_right1')->nullable();
            $table->text('date_signed_right_day1')->nullable();
            $table->text('date_signed_right_month1')->nullable();
            $table->text('date_signed_right_year1')->nullable();
            $table->text('initial_fee_amount2')->nullable();
            $table->text('initial_fee_percentage2')->nullable();
            $table->text('scheme_establishment_alternative2')->nullable();
            $table->text('specific_date2')->nullable();
            $table->text('date_alt_day')->nullable();
            $table->text('date_alt_month')->nullable();
            $table->text('date_alt_year')->nullable();
            $table->text('anniversary_fee2')->nullable();
            $table->text('anniversary_fee1')->nullable();
            $table->text('scheme_anniversary_alternative2')->nullable();
            $table->text('transfer_amount_checkbox')->nullable();
            $table->text('transfer_amount_value')->nullable();
            $table->text('percentage_checkbox_transfer')->nullable();
            $table->text('transfer_percentage_value')->nullable();
            $table->text('transfer_payment2')->nullable();
            $table->text('future_terms2')->nullable();
            $table->text('print_name_left2')->nullable();
            $table->text('signature_left2')->nullable();
            $table->text('date_signed_left_day2')->nullable();
            $table->text('date_signed_left_month2')->nullable();
            $table->text('date_signed_left_year2')->nullable();
            $table->text('print_name_right2')->nullable();
            $table->text('signature_right2')->nullable();
            $table->text('date_signed_right_day2')->nullable();
            $table->text('date_signed_right_month2')->nullable();
            $table->text('date_signed_right_year2')->nullable();
            $table->text('print_name_left_additional1')->nullable();
            $table->text('signature_left_additional')->nullable();
            $table->text('date_signed_left_additional_day3')->nullable();
            $table->text('date_signed_left_additional_month3')->nullable();
            $table->text('date_signed_left_additional_year3')->nullable();
            $table->text('print_name_right_additional')->nullable();



             $table->text('chairman_contact_name')->nullable();
             $table->text('chairman_firm_name')->nullable();
             $table->text('chairman_address_line_1')->nullable();
             $table->text('chairman_address_line_2')->nullable();
             $table->text('chairman_city')->nullable();
             $table->text('chairman_postcode')->nullable();
             $table->text('chairman_telephone')->nullable();
             $table->text('chairman_email')->nullable();

            $table->text('member_true_print_name_1')->nullable();
            $table->text('member_true_print_name_2')->nullable();
            $table->text('member_true_print_name_3')->nullable();
            $table->text('member_true_print_name_4')->nullable();


//            for reason sceme
            $table->text('principal_reason_family')->nullable();




//            common details invest fund

            $table->text('common_funds_number')->nullable();
            $table->text('common_funds_investment_fund_1')->nullable();
            $table->text('common_funds_print_name_1_1')->nullable();
            $table->text('common_funds_print_name_1_2')->nullable();
            $table->text('common_funds_print_name_1_3')->nullable();
            $table->text('common_funds_print_name_1_4')->nullable();
            $table->text('common_funds_reason_for_fund_1')->nullable();
            $table->text('common_funds_investment_fund_2')->nullable();
            $table->text('common_funds_print_name_2_1')->nullable();
            $table->text('common_funds_print_name_2_2')->nullable();
            $table->text('common_funds_print_name_2_3')->nullable();
            $table->text('common_funds_print_name_2_4')->nullable();
            $table->text('common_funds_reason_for_fund_2')->nullable();


//            scheme adviser


            $table->text('scheme_adviser_contact_name')->nullable();
            $table->text('scheme_adviser_company_name')->nullable();
            $table->text('scheme_adviser_address')->nullable();
            $table->text('scheme_adviser_address_line_2')->nullable();
            $table->text('scheme_adviser_city')->nullable();
            $table->text('scheme_adviser_postcode')->nullable();
            $table->text('scheme_adviser_telephone_number')->nullable();
            $table->text('scheme_adviser_email_address')->nullable();
            $table->text('scheme_adviser_regulated_by')->nullable();
            $table->text('scheme_adviser_authorization_number')->nullable();
            $table->text('scheme_adviser_is_part_of_network')->nullable();
            $table->text('scheme_adviser_network_name')->nullable();
            $table->text('scheme_adviser_regulated_by_2')->nullable();
            $table->text('scheme_adviser_company_authorization_number')->nullable();

//          accountant details

            $table->text('accountant_details_contact_name')->nullable();
            $table->text('accountant_details_firm_name')->nullable();
            $table->text('accountant_details_address_line_1')->nullable();
            $table->text('accountant_details_address_line_2')->nullable();
            $table->text('accountant_details_city')->nullable();
            $table->text('accountant_details_postcode')->nullable();
            $table->text('accountant_details_telephone_number')->nullable();
            $table->text('accountant_details_email_address')->nullable();

            $table->text('declaration_signature_1')->nullable();
            $table->text('declaration_print_name_1')->nullable();
            $table->text('declaration_position_1')->nullable();
            $table->text('declaration_day_1')->nullable();
            $table->text('declaration_month_1')->nullable();
            $table->text('declaration_year_1')->nullable();
            $table->text('declaration_signature_2')->nullable();
            $table->text('declaration_print_name_2')->nullable();
            $table->text('declaration_position_2')->nullable();
            $table->text('declaration_day_2')->nullable();
            $table->text('declaration_month_2')->nullable();
            $table->text('declaration_year_2')->nullable();



            // Defined Fee Section
            $table->text('adviser_agrement_initial_fee')->nullable();
            $table->text('pay_following_establishment')->nullable();
            $table->text('day_1')->nullable();
            $table->text('month_1')->nullable();
            $table->text('year_1')->nullable();
//            $table->text('annual_fee')->nullable();
            $table->text('pay_anniversary')->nullable();
            $table->text('day_2')->nullable();
            $table->text('month_2')->nullable();
            $table->text('year_2')->nullable();

            // Percentage Of Fund Or Specific Investments Section
            $table->text('initial_fee_percentage')->nullable();
            $table->text('pay_following_establishment_2')->nullable();
            $table->text('day_3')->nullable();
            $table->text('month_3')->nullable();
            $table->text('year_3')->nullable();
            $table->text('percentage_total_fund')->nullable();
            $table->text('specific_investments')->nullable();
//            $table->text('specific_investments_list')->nullable();




//            adviser fee agrimint



            $table->text('adviser_agrement_initial_fee1')->nullable();
            $table->text('adviser_agrement_pay_following_establishment')->nullable();
            $table->text('adviser_agrement_day_1')->nullable();
            $table->text('adviser_agrement_month_1')->nullable();
            $table->text('adviser_agrement_year_1')->nullable();
            $table->text('adviser_agrement_annual_fee')->nullable();
            $table->text('adviser_agrement_pay_anniversary')->nullable();
            $table->text('adviser_agrement_day_2')->nullable();
            $table->text('adviser_agrement_month_2')->nullable();
            $table->text('adviser_agrement_year_2')->nullable();

            // Percentage Of Fund Or Specific Investments Section
            $table->text('adviser_agrement_initial_fee_percentage1')->nullable();
            $table->text('adviser_agrement_pay_following_establishment_2')->nullable();
            $table->text('adviser_agrement_day_3')->nullable();
            $table->text('adviser_agrement_month_3')->nullable();
            $table->text('adviser_agrement_year_3')->nullable();
            $table->text('adviser_agrement_percentage_total_fund')->nullable();
            $table->text('adviser_agrement_specific_investments')->nullable();
            $table->text('adviser_agrement_specific_investments_list')->nullable();



            $table->text('adviser_agrement_initial_fee_percentage')->nullable();
            $table->text('emp_contr_emp_contr_regular_contribution')->nullable();
            $table->text('adviser_agrement_pay_following_establishment11')->nullable();
            $table->text('adviser_agrement_day_11')->nullable();
            $table->text('adviser_agrement_month_11')->nullable();
            $table->text('adviser_agrement_year_11')->nullable();
            $table->text('adviser_agrement_pay_anniversary11')->nullable();
            $table->text('adviser_agrement_transfer_amount')->nullable();
            $table->text('adviser_agrement_percentage_of_transfer')->nullable();
            $table->text('adviser_agrement_transfer_payments')->nullable();
            $table->text('adviser_agrement_same_terms_apply')->nullable();

            // Declarations - Signing
            $table->text('adviser_agrement_sign_name_left')->nullable();
            $table->text('adviser_agrement_sign_name_right')->nullable();
            $table->text('adviser_agrement_signature_left')->nullable();
            $table->text('adviser_agrement_signature_right')->nullable();
            $table->text('adviser_agrement_day_signed_left')->nullable();
            $table->text('adviser_agrement_month_signed_left')->nullable();
            $table->text('adviser_agrement_year_signed_left')->nullable();
            $table->text('adviser_agrement_day_signed_right')->nullable();
            $table->text('adviser_agrement_month_signed_right')->nullable();
            $table->text('adviser_agrement_year_signed_right')->nullable();

//            interm deed

            $table->text('interim_deed_appointed')->nullable();
            $table->text('interim_deed_network_name')->nullable();
            $table->text('interim_deed_payment_to_network')->nullable();
            $table->text('interim_deed_fees_to_be_paid_by')->nullable();
            $table->text('interim_deed_bank_name')->nullable();
            $table->text('interim_deed_branch')->nullable();
            $table->text('interim_deed_account_number')->nullable();
            $table->text('interim_deed_sort_code')->nullable();
            $table->text('interim_deed_payment_ref')->nullable();
            $table->text('interim_deed_print_name')->nullable();
            $table->text('interim_deed_signature')->nullable();
            $table->text('interim_deed_position')->nullable();
            $table->text('interim_deed_company_stamp')->nullable();
            $table->text('interim_deed_date_signed')->nullable();

//            =========  questionnier member details

            $table->text('member_questionaire_title')->nullable();
            $table->text('member_questionaire_forenames')->nullable();
            $table->text('member_questionaire_surname')->nullable();
            $table->text('member_questionaire_previous_names')->nullable();
            $table->text('member_questionaire_address')->nullable();
            $table->text('member_questionaire_county')->nullable();
            $table->text('member_questionaire_postcode')->nullable();
            $table->text('member_questionaire_time_at_address_years')->nullable();
            $table->text('member_questionaire_time_at_address_months')->nullable();
            $table->text('member_questionaire_previous_address')->nullable();
            $table->text('member_questionaire_previous_county')->nullable();
            $table->text('member_questionaire_previous_postcode')->nullable();
            $table->text('member_questionaire_telephone_number')->nullable();
            $table->text('member_questionaire_email_address')->nullable();
            $table->text('member_questionaire_national_insurance_number')->nullable();
            $table->text('member_questionaire_taxpayer_reference')->nullable();
            $table->text('member_questionaire_occupation')->nullable();
            $table->text('member_questionaire_employer_name')->nullable();
            $table->text('member_questionaire_dob_day')->nullable();
            $table->text('member_questionaire_dob_month')->nullable();
            $table->text('member_questionaire_dob_year')->nullable();
            $table->text('member_questionaire_gender')->nullable();
            $table->text('member_questionaire_nationality')->nullable();
            $table->text('member_questionaire_marital_status')->nullable();
            $table->text('member_questionaire_employment_status')->nullable();
            $table->text('member_questionaire_current_occupation')->nullable();
            $table->text('member_questionaire_job_title')->nullable();
            $table->text('member_questionaire_opted_out')->nullable();
            $table->text('member_questionaire_protection')->nullable();
            $table->text('member_questionaire_primary_protection')->nullable();
            $table->text('member_questionaire_lump_sum_protection')->nullable();
            $table->text('member_questionaire_mpaa')->nullable();
            $table->text('member_questionaire_mpaa_day')->nullable();
            $table->text('member_questionaire_mpaa_month')->nullable();
            $table->text('member_questionaire_mpaa_year')->nullable();

//            entitlement
            $table->text('entitlement_tax_relief_option')->nullable();

//            financoial adviser


            $table->text('financial_que_adviser_same')->nullable();
            $table->text('financial_que_contact_name')->nullable();
            $table->text('financial_que_company_name')->nullable();
            $table->text('financial_que_address')->nullable();
            $table->text('financial_que_country')->nullable();
            $table->text('financial_que_postcode')->nullable();
            $table->text('financial_que_telephone_number')->nullable();
            $table->text('financial_que_email_address')->nullable();
            $table->text('financial_que_regulated_by')->nullable();
            $table->text('financial_que_authorisation_number')->nullable();
            $table->text('financial_que_network_name')->nullable();
            $table->text('financial_que_network_regulated_by')->nullable();
            $table->text('financial_que_company_authorisation_number')->nullable();

//    comon investment


            $table->text('fund_common_investment_1')->nullable();
            $table->text('fund_investment_1')->nullable();
            $table->text('fund_common_investment_2')->nullable();
            $table->text('fund_investment_2')->nullable();

            $table->text('fund_additional_details')->nullable();

//            member investment

            $table->text('members_fund_investment_1')->nullable();
            $table->text('members_fund_investment_2')->nullable();
            $table->text('members_fund_investment_3')->nullable();
            $table->text('members_fund_investment_4')->nullable();


//            nominational memories


            // Beneficiaries
            $table->text('nomination_beneficiary_1_name')->nullable();
            $table->text('nomination_beneficiary_1_relationship')->nullable();
            $table->text('nomination_beneficiary_1_percentage')->nullable();

            $table->text('nomination_beneficiary_2_name')->nullable();
            $table->text('nomination_beneficiary_2_relationship')->nullable();
            $table->text('nomination_beneficiary_2_percentage')->nullable();

            $table->text('nomination_beneficiary_3_name')->nullable();
            $table->text('nomination_beneficiary_3_relationship')->nullable();
            $table->text('nomination_beneficiary_3_percentage')->nullable();

            // Charities
            $table->text('nomination_charity_1_name')->nullable();
            $table->text('nomination_charity_1_percentage')->nullable();

            $table->text('nomination_charity_2_name')->nullable();
            $table->text('nomination_charity_2_percentage')->nullable();

            $table->text('nomination_charity_3_name')->nullable();
            $table->text('nomination_charity_3_percentage')->nullable();


//            personal contriution

            $table->text('personal_regular_contribution')->nullable();
            $table->text('personal_single_contribution')->nullable();
            $table->text('personal_source_of_funds')->nullable();
            $table->text('personal_contribution_frequency')->nullable();
            $table->text('personal_start_date_day')->nullable();
            $table->text('personal_start_date_month')->nullable();
            $table->text('personal_start_date_year')->nullable();
            $table->text('personal_employer_pay')->nullable();

//            employeers details


            $table->text('questionaries_employer_name')->nullable();
            $table->text('questionaries_registered_address')->nullable();
            $table->text('questionaries_country')->nullable();
            $table->text('questionaries_postcode')->nullable();
            $table->text('questionaries_telephone_number')->nullable();
            $table->text('questionaries_email_address')->nullable();
            $table->text('questionaries_trading_address')->nullable();
            $table->text('questionaries_trading_country')->nullable();
            $table->text('questionaries_trading_postcode')->nullable();
            $table->text('questionaries_employer_status')->nullable();
            $table->text('questionaries_nature_of_business')->nullable();
            $table->text('questionaries_employer_year_end_day')->nullable();
            $table->text('questionaries_employer_year_end_month')->nullable();
            $table->text('questionaries_employer_year_end_year')->nullable();
            $table->text('questionaries_registration_number')->nullable();
            $table->text('questionaries_employed_since_day')->nullable();
            $table->text('questionaries_employed_since_month')->nullable();
            $table->text('questionaries_employed_since_year')->nullable();
            $table->text('questionaries_director_status')->nullable();
            $table->text('questionaries_shareholdings')->nullable();


//          employer cintribution

            $table->text('emp_contr_regular_contribution')->nullable();
            $table->text('emp_contr_single_contribution')->nullable();
            $table->text('emp_contr_frequency')->nullable();
            $table->text('emp_contr_day')->nullable();
            $table->text('emp_contr_month')->nullable();
            $table->text('emp_contr_year')->nullable();

            $table->text('empl_dec_signature')->nullable();
            $table->text('empl_dec_print_name')->nullable();
            $table->text('empl_dec_position')->nullable();
            $table->text('empl_dec_day')->nullable();
            $table->text('empl_dec_month')->nullable();
            $table->text('empl_dec_year')->nullable();

//            transfer authority


            $table->text('transf_auth_signature')->nullable();
            $table->text('transf_auth_print_name')->nullable();
            $table->text('transf_auth_plan_scheme_no')->nullable();
            $table->text('transf_auth_day')->nullable();
            $table->text('transf_auth_month')->nullable();
            $table->text('transf_auth_year')->nullable();

//            transfer to plan

            $table->text('trans_plan_member_name')->nullable();
            $table->text('trans_plan_telephone_number')->nullable();
            $table->text('trans_plan_email_address')->nullable();
            $table->text('trans_plan_transfer_scheme_type')->nullable();
            $table->text('trans_plan_address')->nullable();
            $table->text('trans_plan_postcode')->nullable();
            $table->text('trans_plan_country')->nullable();
            $table->text('trans_plan_scheme_type')->nullable(); // yes/no for occupational scheme
            $table->text('trans_plan_plan_scheme_name')->nullable();
            $table->text('trans_plan_scheme_number')->nullable();
            $table->text('trans_plan_reference')->nullable();
            $table->text('trans_plan_value_of_fund')->nullable();
            $table->text('trans_plan_wish_transfer')->nullable(); // yes/no for transfer into arrangement
            $table->text('trans_plan_important_to_transfer')->nullable(); // yes/no for important value
            $table->text('trans_plan_existing_scheme')->nullable(); // yes/no for crystallisation
            $table->text('trans_plan_block_transfer')->nullable(); // yes/no for block transfer

//            member concent

            $table->text('member_consent_contact_me')->nullable(); // Yes/No for contacting about products and services
            $table->text('member_consent_pass_contact')->nullable(); // Yes/No for passing contact details to subsidiaries
            $table->text('member_consent_prefer_email')->nullable(); // Yes/No for preference to contact by email
            $table->text('member_consent_prefer_post')->nullable(); // Yes/No for preference to contact by post
            $table->text('member_consent_signature')->nullable();
            $table->text('member_consent_print_name')->nullable();
            $table->text('member_consent_date_day')->nullable();
            $table->text('member_consent_date_month')->nullable();
            $table->text('member_consent_date_year')->nullable();
            $table->text('date_alternative2')->nullable();

//            member declaration

            $table->text('member_declra_waive_rights')->nullable(); // Checkbox for cancellation rights
            $table->text('member_declra_responsibility_declaration')->nullable(); // Parental responsibility declaration
            $table->text('member_declra_confirm_information')->nullable(); // Information confirmation text
            $table->text('member_declra_notify_information')->nullable(); // Notify information change text
            $table->text('member_declra_consent_declaration')->nullable(); // Consent declaration text
            $table->text('member_declra_signature')->nullable(); // Member's signature
            $table->text('member_declra_print_name')->nullable(); // Member's print name
            $table->text('member_declra_date_day')->nullable(); // Day part of date
            $table->text('member_declra_date_month')->nullable(); // Month part of date
            $table->text('member_declra_date_year')->nullable(); // Year part of date


            $table->text('member_declra_waive_cancellation_rights')->nullable(); // Yes/No for waiving cancellation rights
            $table->text('member_declra_parental_responsibility')->nullable(); // Yes/No for parental responsibility
            $table->text('notes')->nullable();

//            last text area


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fpts');
    }
};
