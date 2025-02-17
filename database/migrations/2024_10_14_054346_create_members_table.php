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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->text('role')->nullable(); // Title (Mr, Mrs, etc.)
            $table->text('forename')->nullable(); // Forename
            $table->text('surname')->nullable(); // Surname
            $table->text('address')->nullable(); // Residential Address
            $table->text('country')->nullable(); // Country
            $table->text('postcode')->nullable(); // Postcode
            $table->text('telephone')->nullable(); // Telephone Number
            $table->text('email')->nullable(); // Email Address
            $table->text('gender')->nullable(); // Gender (stored as text)
            $table->text('nationality')->nullable(); // Nationality or Citizenship
            $table->text('dob')->nullable(); // Date of Birth
            $table->text('marital_status')->nullable();
            $table->text('spouse_dob')->nullable();
            $table->text('pension_order')->nullable(); // Yes/No for Pension Sharing or Pension Earmarking Order
            $table->text('occupation')->nullable(); // Occupation (stored in text)
            $table->text('employment_status')->nullable(); // Employment Status (stored in text)
            $table->text('opted_out')->nullable(); // Yes/No for Opted Out of Pension Arrangement
            $table->text('pension_protection')->nullable(); // Yes/No for Protection of Existing Pension Rights
            $table->text('annual_allowance')->nullable(); // Yes/No for Annual Allowance
            $table->text('first_payment_date')->nullable(); //

            // Tax Relief Benefits
            $table->text('tax_relief')->nullable();

            // Contribution
            $table->text('contribute_regular_contribution')->nullable(); // Regular Contribution stored as text
            $table->text('contribute_single_contribution')->nullable(); // Single Contribution stored as text
            $table->text('payment_frequency')->nullable(); // Payment Frequency (Monthly, Quarterly, etc.)
            $table->text('employer_pay')->nullable();

            // Employer Detail
            $table->text('employer_name')->nullable(); // Employer's name
            $table->text('registered_office')->nullable(); // Registered office address
            $table->text('employee_postcode')->nullable(); // Postcode
            $table->text('telephone_number')->nullable(); // Telephone number (including area code)
            $table->text('employee_contact_name')->nullable(); // Contact person's name
            $table->text('email_address')->nullable(); // Email address
            $table->text('trading_address')->nullable(); // Trading address (if different from registered office)
            $table->text('trading_postcode')->nullable(); // Postcode for trading address
            $table->text('fax_number')->nullable(); // Fax number (including area code)
            $table->text('additional_telephone')->nullable();

            // Employer Contribution
            $table->text('regular_contribution')->nullable(); // Regular contribution provided by the employer
            $table->text('single_contribution')->nullable(); // Single contribution provided by the employer
            $table->text('start_date')->nullable(); // Start Date for Regular Contributions

            // Employee Declaration
            $table->text('signature')->nullable(); // Signature of the authorised signatory
            $table->text('print_name')->nullable(); // Print name of the authorised signatory
            $table->text('position')->nullable(); // Position of the authorised signatory
            $table->text('date')->nullable(); // Date

            // Financial Adviser
            $table->text('financial_contact_name')->nullable(); // Contact name of the financial adviser
            $table->text('financial_company_name')->nullable(); // Company name of the financial adviser
            $table->text('street_address')->nullable(); // Street address
            $table->text('city')->nullable(); // City of the address
            $table->text('financial_postcode')->nullable(); // Postcode of the address
            $table->text('financial_telephone_number')->nullable(); // Telephone number of the adviser
            $table->text('financial_fax_number')->nullable(); // Fax number of the adviser
            $table->text('financial_email_address')->nullable(); // Email address of the adviser
            $table->text('regulated_by')->nullable(); // Authority regulating the adviser
            $table->text('authorisation_number')->nullable(); // Authorisation number of the adviser
            $table->text('network_status')->nullable(); // Whether part of a network (Yes/No)
            $table->text('network_name')->nullable(); // Name of the network or principal
            $table->text('regulated_by_second')->nullable(); // Regulated by (again)
            $table->text('company_authorisation_number')->nullable(); // Company authorisation number

            // Beneficiaries
            $table->text('name')->nullable(); // Name of the beneficiary or charity
            $table->text('relationship')->nullable(); // Relationship (only for beneficiaries, null for charities)
            $table->text('percentage')->nullable(); // Percentage allocation
            $table->text('type')->nullable();

            // Investment
            $table->text('investment_option')->nullable(); // Full or Single Investment

            $table->text('contact_name')->nullable(); // Contact name of investment manager
            $table->text('investment_company_name')->nullable(); // Company name of investment manager
            $table->text('investment_address')->nullable(); // Address
            $table->text('investment_postcode')->nullable(); // Postcode
            $table->text('investment_telephone_number')->nullable(); // Telephone number
            $table->text('investment_fax_number')->nullable(); // Fax number
            $table->text('investment_email_address')->nullable(); // Email address
            $table->text('plan_type')->nullable(); // Plan type

            // Benefits
            $table->text('take_benefits_soon')->nullable(); // Whether the user intends to take benefits soon
            $table->text('benefits_method')->nullable(); // Method of taking benefits
            $table->text('benefit_start_date')->nullable(); // Anticipated benefit start date

            // Other Benefits
            $table->text('provider_name')->nullable(); // Provider's Full Name
            $table->text('other_benefits_address')->nullable(); // Address
            $table->text('other_benefits_postcode')->nullable(); // Postcode
            $table->text('other_telephone_number')->nullable(); // Telephone Number
            $table->text('other_fax_number')->nullable(); // Fax Number
            $table->text('other_email_address')->nullable(); // Email Address
            $table->text('plan_scheme_type')->nullable(); // Plan/Scheme Type
            $table->text('is_occupational_scheme')->nullable(); // Is this an occupational scheme?
            $table->text('plan_scheme_name')->nullable(); // Plan/Scheme Name
            $table->text('pension_scheme_tax_reference')->nullable(); // Pension Scheme Tax Reference
            $table->text('fund_value', 10, 2)->nullable(); // Value of Fund to be Transferred
            $table->text('full_value_scheme')->nullable(); // Does this represent the full value of the current plan/scheme?
            $table->text('funds_crystallised')->nullable(); // Have any funds been crystallised?
            $table->text('crystallised_method')->nullable(); // Crystallisation method
            $table->text('other_signature')->nullable(); // Signature
            $table->text('other_print_name')->nullable(); // Print Name
            $table->text('other_date')->nullable(); // Date

            // Member Consent Section
            $table->text('contact_consent')->nullable(); // Contact consent for products and services
            $table->text('passing_contact_consent')->nullable(); // Consent for passing contact to other subsidiaries
            $table->text('contact_method')->nullable(); // Preferred contact method

            // Signature, Name, and Date for Consent
            $table->text('signature_consent')->nullable(); // Signature for consent
            $table->text('signatur_print_name')->nullable(); // Printed name for consent
            $table->text('signature_date')->nullable(); // Date for consent

            // Member Declaration Section
            $table->text('signature_declaration')->nullable(); // Signature for declaration
            $table->text('print_name_declaration')->nullable(); // Printed name for declaration
            $table->text('position_declaration')->nullable(); // Position of the person signing the declaration
            $table->text('declaration_date')->nullable(); // Date of the declaration

            // Company Information
            $table->text('infor_company_name')->nullable();
            $table->text('entity_type')->nullable();
            $table->text('registered_address')->nullable();
            $table->text('registered_number')->nullable();
            $table->text('infor_country')->nullable();
            $table->text('company_info_postcode')->nullable();
            $table->text('nature_of_business')->nullable();

            // Control Information

            $table->text('individual_verification')->nullable(); // Stores individual verification checkbox
            $table->text('beneficial_verification')->nullable(); // Stores beneficial owner verification checkbox

            // Certification Information
            $table->text('standard_verification')->nullable();
            $table->text('confirmation_letter')->nullable();
            $table->text('open_account')->nullable();

            // Signature Information
            $table->text('name_of_regulated_firm')->nullable();
            $table->text('regulator_name_reference')->nullable();
            $table->text('regulated_individual_name')->nullable();
            $table->text('regulated_individual_reference')->nullable();
            $table->text('part_f_signature')->nullable();
            $table->text('regulated_name')->nullable();
            $table->text('regulated_position')->nullable();
            $table->text('regulated_date')->nullable();

            // Applicant Information
            $table->text('applicant_name')->nullable();
            $table->text('application_dob')->nullable();
            $table->text('applicant_address')->nullable();
            $table->text('application_country')->nullable();
            $table->text('applicant_info_postcode')->nullable();

            // Previous Address Information (if changed)
            $table->text('changed_address')->nullable();
            $table->text('previous_country')->nullable();
            $table->text('previous_postcode')->nullable();

            // Certification Information
            $table->text('regulator_firm_name')->nullable();
            $table->text('regulator_reference')->nullable();
            $table->text('regulated_cer_individual_name')->nullable();
            $table->text('regulated_certification_individual_reference')->nullable();
            $table->text('certification_signature')->nullable();
            $table->text('certification_name')->nullable();
            $table->text('certification_position')->nullable();
            $table->text('certification_date')->nullable();

            // Section One - Initial and ongoing fees
            $table->text('defined_fee')->nullable();  // Defined Fee for arranging SIPP
            $table->text('annual_fee_defined')->nullable(); // Annual Fee
            $table->text('date_fee')->nullable(); // Payment date

            $table->text('percentage_fund')->nullable(); // Percentage of Fund or specific investments
            $table->text('annual_fee_fund')->nullable(); // Annual Fee
            $table->text('date_fund')->nullable(); // Payment date for fund

            $table->text('gross_contribution')->nullable(); // Percentage of gross contribution
            $table->text('annual_fee_gross')->nullable(); // Annual Fee for gross contribution
            $table->text('date_gross')->nullable(); // Payment date for gross contributions

            // Section Two - Transfer Related Fees
            $table->text('transfer_value')->nullable(); // Value of Transfer
            $table->text('fee_transfer')->nullable(); // Fee for transfer
            $table->text('payment_received')->nullable(); // Payment Received Date

            // Apply for Future Transfers
            $table->text('future_transfers')->nullable(); // Future transfers

            // SIPP Member Section
            $table->text('signature_member')->nullable();
            $table->text('print_name_member')->nullable();
            $table->text('date_member')->nullable();

            // Financial Adviser Section
            $table->text('adviser_network')->nullable();
            $table->text('name_of_network')->nullable();
            $table->text('network_payment')->nullable();

            // Payment Information
            // Store multiple values as JSON
            $table->text('bank_name')->nullable();
            $table->text('branch')->nullable();
            $table->text('account_name')->nullable();
            $table->text('account_number')->nullable();
            $table->text('sort_code')->nullable();

            // Adviser Information
            $table->text('signature_adviser')->nullable();
            $table->text('signature_segnature')->nullable();
            $table->text('name_adviser')->nullable();
            $table->text('position_adviser')->nullable();
            $table->text('date_adviser')->nullable();
            $table->text('company_stamp')->nullable();

            // Bank Details
            $table->text('pension_scheme_type')->nullable();
            $table->text('pension_scheme_name')->nullable();
            $table->text('pension_provider_name')->nullable();
            $table->text('professional_trustee_address')->nullable();
            $table->text('scheme_admin_address')->nullable();
            $table->text('employer_pay_premiums')->nullable();
            $table->text('hmrc_registration_number')->nullable();
            $table->text('alt_scheme_admin_address')->nullable();
            $table->text('statements_required')->nullable();

            // Tanee and Member
            $table->text('member_title')->nullable();
            $table->text('first_name')->nullable();
            $table->text('middle_name')->nullable();
            $table->text('member_surname')->nullable();
            $table->text('date_of_birth')->nullable();
            $table->text('tanee_member_gender')->nullable();
            $table->text('member_nationality')->nullable();
            $table->text('country_of_birth')->nullable();
            $table->text('home_telephone_number')->nullable();
            $table->text('mobile_number')->nullable();
            $table->text('member_email_address')->nullable();
            $table->text('current_address')->nullable();
            $table->text('date_moved_in')->nullable();
            $table->text('member_statements_required')->nullable();
            $table->text('is_member_trustee' )->nullable();
            $table->text('is_online_banking_required')->nullable();

            // Bank Details Pay
            $table->text('sipp_ssas_account')->nullable();
            $table->text('cheque_book_required')->nullable();
            $table->text('fixed_term_savings_sipp_ssas_account')->nullable();

            // Amount to be deposited
            $table->text('amount_to_be_deposited', 15, 2)->nullable(); // Amount to be deposited
            $table->text('term_months')->nullable(); // Term in months


            // Mandate
            $table->text('professional_trustee_only')->nullable();
            $table->text('authorised_signatories')->nullable();
            $table->text('signing_instructions')->nullable();

            // Privacy Notices
            $table->text('fraud_prevention')->nullable();
            $table->text('declaration')->nullable();
            $table->text('certification')->nullable();


            // Member Trustee
            $table->text('trustee_name')->nullable();
            $table->text('trustee_signature')->nullable();
            $table->text('trustee_date')->nullable();

            // Professional Adviser Details
            $table->text('company_name')->nullable(); // Name of the company
            $table->text('company_address')->nullable(); // Address of the company
            $table->text('company_post_code')->nullable(); // Post code
            $table->text('company_telephone')->nullable(); // Telephone number
            $table->text('contact_person')->nullable(); // Name of the contact person
            $table->text('contact_email')->nullable(); // Email address

            // Part One
            $table->text('part_one_surname')->nullable(); // Surname (last name)
            $table->text('given_name')->nullable(); // Given name (first name)
            $table->text('additional_name')->nullable(); // Middle or additional name (optional)
            $table->text('honorific_title')->nullable(); // Title (Mr, Mrs, etc.)
            $table->text('part_one_gender')->nullable(); // Gender (Male, Female, Other)
            $table->text('home_address')->nullable(); // Home address
            $table->text('locality')->nullable(); // Locality or city
            $table->text('zip_code')->nullable(); // ZIP or postal code
            $table->text('region')->nullable(); // Region, state, or province
            $table->text('nation')->nullable(); // Country of residence
            $table->text('birth_date')->nullable(); // Date of birth
            $table->text('birthplace_city')->nullable(); // City of birth
            $table->text('birthplace_nation')->nullable(); // Country of birth

            // Part Two
            $table->text('tax_residence_country')->nullable(); // Country or jurisdiction of tax residence
            $table->text('tin_number')->nullable(); // Taxpayer Identification Number (TIN)
            $table->text('tin_reason')->nullable(); // Reason A, B, or C if TIN is not available
            $table->text('reason_b_explanation')->nullable(); // Explanation for Reason B (if applicable)
            $table->text('tax_residence_more_than_three')->nullable(); // Checkbox for more than three tax residencies
            $table->text('confirm_all_residences')->nullable(); // Checkbox confirming all tax residences included
            $table->text('us_person', ['Yes', 'No'])->nullable(); // Radio button for US Person

            // Part Three
            $table->text('residency_mismatch_reason')->nullable();
            $table->text('additional_details')->nullable(); // Additional details

            // Part Four
            $table->text('part_four_signature')->nullable();
            $table->text('signature_print_name')->nullable();
            $table->integer('sign_day')->nullable();
            $table->integer('sign_month')->nullable();
            $table->integer('sign_year')->nullable();
            $table->text('capacity')->nullable();


            $table->json('charity_name')->nullable(); // JSON for Enhanced Protection or others
            $table->json('charity_percentage')->nullable(); // JSON for Enhanced Protection or others


            $table->json('protection_type')->nullable(); // JSON for Enhanced Protection or others
            $table->json('beneficiary_name')->nullable(); // JSON for Enhanced Protection or others
            $table->json('beneficiary_dob')->nullable(); // JSON for Enhanced Protection or others
            $table->json('beneficiary_address')->nullable(); // JSON for Enhanced Protection or othersbeneficiary_address
            $table->json('investment_details')->nullable(); // Networ
            $table->json('controller_names')->nullable(); // Stores array of names of controllers
            $table->json('controller_dobs')->nullable(); // Stores array of controller DOBs
            $table->json('beneficial_owner_names')->nullable(); // Stores array of names of beneficial owners
            $table->json('beneficial_owner_dobs')->nullable(); // Stores
            $table->json('privacy_print_name')->nullable();
            $table->json('privacy_signature')->nullable();
            $table->json('privacy_position')->nullable();
            $table->json('privacy_date')->nullable();
            $table->json('funds_deposited_by')->nullable(); // Store multiple values as JSON
            $table->json('fees_paid_by')->nullable();
            $table->enum('status',['active','pending'])->default('active');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
