<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SimpleMail;
use App\Http\Controllers\Controller;
use App\Models\Advisers;
use App\Models\Member;
use App\Models\Memberdetail;
use App\Models\Fpt;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
     public function members()
    {

        $memberOasis =  User::where('role', 'oasis_sipp')->get();
        $role_member = 'oasis_sipp';
        return view('dashboard.member.createOasisSipp', compact('memberOasis','role_member'));
    }
    public function memberSipp()
    {

        $memberOasis =  User::where('role', 'sipp_property')->get();
         $role_member = 'sipp_property';
        return view('dashboard.member.createOasisSipp', compact('memberOasis','role_member'));
    }

    public function memberSippFull()
    {

        $memberOasis =  User::where('role', 'full_sipp_property')->get();
         $role_member  = 'full_sipp_property';
        return view('dashboard.member.createOasisSipp', compact('memberOasis','role_member'));
    }



    public function memberStore(Request $request)
    {
        
        
        $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email|unique:users,email',
        'role_member' => 'required|string',
    ]);

        $userMember = new User();
        $userMember->name = $request->user_name;
        $userMember->creator_id = auth()->user()->id;   
        $userMember->email = $request->user_email;
        $userMember->password = Hash::make('12345678');
        
        
       
    $userMember->member_details_check = 'member_details_check';
    $userMember->tickets_check = 'tickets_check';
    $userMember->support_check = 'support_check';
    $userMember->faq_check = 'faq_check';
        
        $userMember->role = $request->role_member;
         $userMember->save();

        $membersStore = new Member();
        $membersStore->role = $userMember->id;
        $membersStore->creater_id = auth()->user()->id;
        $membersStore->forename = $request->input('forename');  // Forename
        $membersStore->surname = $request->input('surname');  // Surname
        $membersStore->address = $request->input('address');  // Residential Address
        $membersStore->country = $request->input('country');  // Country
        $membersStore->postcode = $request->input('postcode');  // Postcode
        $membersStore->telephone = $request->input('telephone');  // Telephone Number
        $membersStore->email = $request->input('email');  // Email Address

        $membersStore->nationality = $request->input('nationality');  // Nationality or Citizenship
        $membersStore->dob = $request->input('dob');  // Date of Birth

        $membersStore->spouse_dob = $request->input('spouse_dob');  // Spouse's Date of Birth
        $membersStore->pension_order = $request->input('pension_order');  // Pension Sharing or Pension Earmarking Order (Yes/No)
        $membersStore->occupation = $request->input('occupation');  // Occupation
        $membersStore->employment_status = $request->input('employment_status');  // Employment Status
        $membersStore->opted_out = $request->opted_out;  // Opted Out of Pension Arrangement (Yes/No)
        $membersStore->pension_protection = $request->pension_protection;  // Protection of Existing Pension Rights (Yes/No)

        $membersStore->annual_allowance = $request->annual_allowance;  // Annual Allowance (Yes/No)
        $membersStore->first_payment_date = $request->first_payment_date;

        //<!-- contribution -->

        $membersStore->contribute_regular_contribution = $request->contribute_regular_contribution;  // Regular Contribution
        $membersStore->contribute_single_contribution = $request->contribute_single_contribution;  // Single Contribution
        $membersStore->payment_frequency = $request->payment_frequency;  // Payment Frequency (e.g., Monthly, Quarterly)
        $membersStore->employer_pay = $request->employer_pay;  // Whe

        //<!-- employer detail -->

        $membersStore->employer_name = $request->input('employer_name');  // Employer's name
        $membersStore->registered_office = $request->input('registered_office');  // Registered office address
        $membersStore->employee_postcode = $request->input('employee_postcode');  // Postcode
        $membersStore->telephone_number = $request->input('telephone_number');  // Telephone number (including area code)
        $membersStore->employee_contact_name = $request->input('employee_contact_name');  // Contact person's name
        $membersStore->email_address = $request->input('email_address');  // Email address
        $membersStore->trading_address = $request->input('trading_address');  // Trading address (if different from registered office)
        $membersStore->trading_postcode = $request->input('trading_postcode');  // Postcode for trading address
        $membersStore->fax_number = $request->input('fax_number');  // Fax number (including area code)
        $membersStore->additional_telephone = $request->input('additional_telephone');  // Additional telephone number

        //<!-- employer contribution -->

        $membersStore->regular_contribution = $request->input('regular_contribution');  // Regular contribution provided by the employer
        $membersStore->single_contribution = $request->input('single_contribution');  // Single contribution provided by the employer
        $membersStore->payment_frequency = $request->input('payment_frequency');  // Frequency of regular contributions (e.g., Monthly, Quarterly)
        $membersStore->start_date = $request->input('start_date');  // Start date

        //<!-- employee declaration -->

        $membersStore->signature = $request->input('signature');  // Signature of the authorised signatory
        $membersStore->print_name = $request->input('print_name');  // Print name of the authorised signatory
        $membersStore->position = $request->input('position');  // Position of the authorised signatory
        $membersStore->date = $request->input('date');  // D

        //<!-- financial adviser -->

        $membersStore->financial_contact_name = $request->input('financial_contact_name');  // Contact name of the adviser
        $membersStore->financial_company_name = $request->input('financial_company_name');  // Company name of the adviser
        $membersStore->street_address = $request->input('street_address');  // Street address
        $membersStore->city = $request->input('city');  // City
        $membersStore->financial_postcode = $request->input('financial_postcode');  // Postcode
        $membersStore->financial_telephone_number = $request->input('financial_telephone_number');  // Telephone number
        $membersStore->financial_fax_number = $request->input('financial_fax_number');  // Fax number
        $membersStore->financial_email_address = $request->input('financial_email_address');  // Email address
        $membersStore->regulated_by = $request->input('regulated_by');  // Authority regulating the adviser
        $membersStore->authorisation_number = $request->input('authorisation_number');  // Authorisation number
        $membersStore->network_status = $request->input('network_status');  // Whether part of a network (Yes/No)
        $membersStore->network_name = $request->input('network_name');  // Name of the network
        $membersStore->regulated_by_second = $request->input('regulated_by_second');  // Regulated by (second time)
        $membersStore->company_authorisation_number = $request->input('company_authorisation_number');  // Company authorisation number

        //<!-- beneficiries -->


        $membersStore->type = $request->input('type');  // Typ

        //<!-- investment -->

        $membersStore->investment_option = $request->input('investment_option');  // Full or Single Investment

        $membersStore->contact_name = $request->input('contact_name');  // Contact name of the investment manager
        $membersStore->investment_company_name = $request->input('investment_company_name');  // Company name of the investment manager
        $membersStore->investment_address = $request->input('investment_address');  // Address
        $membersStore->investment_postcode = $request->input('investment_postcode');  // Postcode
        $membersStore->investment_telephone_number = $request->input('investment_telephone_number');  // Telephone number
        $membersStore->investment_fax_number = $request->input('investment_fax_number');  // Fax number
        $membersStore->investment_email_address = $request->input('investment_email_address');  // Email address
        $membersStore->plan_type = $request->input('plan_type');  // Plan type

        //<!-- benefits -->

        // Assign the request inputs to the respective fields in the model
        $membersStore->take_benefits_soon = $request->input('take_benefits_soon');  // Whether the user intends to take benefits soon
        $membersStore->benefits_method = $request->input('benefits_method');  // Method of taking benefits
        $membersStore->benefit_start_date = $request->input('benefit_start_date');

        //<!-- other benefits -->

        $membersStore->provider_name = $request->input('provider_name');  // Provider's Full Name
        $membersStore->other_benefits_address = $request->input('other_benefits_address');  // Address
        $membersStore->other_benefits_postcode = $request->input('other_benefits_postcode');  // Postcode
        $membersStore->other_telephone_number = $request->input('other_telephone_number');  // Telephone Number
        $membersStore->other_fax_number = $request->input('other_fax_number');  // Fax Number
        $membersStore->other_email_address = $request->input('other_email_address');  // Email Address
        $membersStore->plan_scheme_type = $request->input('plan_scheme_type');  // Plan/Scheme Type
        $membersStore->is_occupational_scheme = $request->input('is_occupational_scheme');  // Is this an occupational scheme?
        $membersStore->plan_scheme_name = $request->input('plan_scheme_name');  // Plan/Scheme Name
        $membersStore->pension_scheme_tax_reference = $request->input('pension_scheme_tax_reference');  // Pension Scheme Tax Reference
        $membersStore->fund_value = $request->input('fund_value');  // Value of Fund to be Transferred
        $membersStore->full_value_scheme = $request->input('full_value_scheme');  // Does this represent the full value of the current plan/scheme?
        $membersStore->funds_crystallised = $request->input('funds_crystallised');  // Have any funds been crystallised?
        $membersStore->crystallised_method = $request->input('crystallised_method');  // Crystallisation method
        $membersStore->other_signature = $request->input('other_signature');  // Signature
        $membersStore->other_print_name = $request->input('other_print_name');  // Print Name
        $membersStore->other_date = $request->input('other_date');

        //<!-- member constent -->

        // Member Consent Section

        $membersStore->contact_consent = $request->input('contact_consent');  // Contact consent for products and services
        $membersStore->passing_contact_consent = $request->input('passing_contact_consent');  // Consent for passing contact to other subsidiaries
        $membersStore->contact_method = $request->input('contact_method');  // Preferred contact method (email or post)

        // Signature, Name, and Date for Consent

        // Assign the request inputs to the respective fields in the model
        $membersStore->signature_consent = $request->input('signature_consent');  // Signature for consent
        $membersStore->signatur_print_name = $request->input('signatur_print_name');  // Printed name for consent
        $membersStore->date = $request->input('date');  // Da

        // Member Declaration Section

        $membersStore->signature_declaration = $request->input('signature_declaration');  // Signature for declaration
        $membersStore->print_name_declaration = $request->input('print_name_declaration');  // Printed name for declaration
        $membersStore->position_declaration = $request->input('position_declaration');  // Position of the person signing the declaration
        $membersStore->declaration_date = $request->input('declaration_date');

        //<!-- Corporate -->

        // Company Information

        $membersStore->infor_company_name = $request->input('infor_company_name');  // Company Name
        $membersStore->entity_type = $request->input('entity_type');  // Entity Type
        $membersStore->registered_address = $request->input('registered_address');  // Registered Address
        $membersStore->registered_number = $request->input('registered_number');  // Registered Number
        $membersStore->infor_country = $request->input('infor_country');  // Country
        $membersStore->company_info_postcode = $request->input('company_info_postcode');  // Postcode
        $membersStore->nature_of_business = $request->input('nature_of_business');  // Nature of Business

        // Control Information

        $membersStore->individual_verification = $request->input('individual_verification');


        $membersStore->beneficial_verification = $request->input('beneficial_verification');  // Beneficial owner verification (Yes/No)

        // Certification Information
        $membersStore->standard_verification = $request->input('standard_verification');  // Standard verification (Yes/No)
        $membersStore->confirmation_letter = $request->input('confirmation_letter');  // Confirmation letter (Yes/No)
        $membersStore->open_account = $request->input('open_account');  // Open account (Yes/No)

        // Signature Information
        $membersStore->name_of_regulated_firm = $request->input('name_of_regulated_firm');  // Name of the regulated firm
        $membersStore->regulator_name_reference = $request->input('regulator_name_reference');  // Regulator's name and reference
        $membersStore->regulated_individual_name = $request->input('regulated_individual_name');  // Name of the regulated individual
        $membersStore->regulated_individual_reference = $request->input('regulated_individual_reference');  // Reference of the regulated individual
        $membersStore->signature_segnature = $request->input('signature_segnature');  // Signature
        $membersStore->regulated_name = $request->input('regulated_name');  // Name of the signatory
        $membersStore->regulated_position = $request->input('regulated_position');  // Position of the signatory
        $membersStore->regulated_date = $request->input('regulated_date');


        // Applicant Information
        $membersStore->applicant_name = $request->input('applicant_name');  // Applicant's Name
        $membersStore->application_dob = $request->input('application_dob');  // Applicant's Date of Birth
        $membersStore->applicant_address = $request->input('applicant_address');  // Applicant's Address
        $membersStore->application_country = $request->input('application_country');  // Applicant's Country
        $membersStore->applicant_info_postcode = $request->input('applicant_info_postcode');  // Applicant's Postcode

        // Previous Address Information (if changed)
        $membersStore->changed_address = $request->input('changed_address');  // Previous Address (if changed)
        $membersStore->previous_country = $request->input('previous_country');  // Previous Country (if changed)
        $membersStore->previous_postcode = $request->input('previous_postcode');  // Previous Postcode (if changed)

        // Certification Information
        $membersStore->regulator_firm_name = $request->input('regulator_firm_name');  // Regulator Firm Name
        $membersStore->regulator_reference = $request->input('regulator_reference');  // Regulator Reference
        $membersStore->regulated_cer_individual_name = $request->input('regulated_cer_individual_name');  // Regulated Individual's Name
        $membersStore->regulated_certification_individual_reference = $request->input('regulated_certification_individual_reference');  // Regulated Individual's Reference
        $membersStore->certification_signature = $request->input('certification_signature');  // Signature
        $membersStore->certification_name = $request->input('certification_name');  // Printed Name
        $membersStore->certification_position = $request->input('certification_position');  // Position
        $membersStore->certification_date = $request->input('certification_date');  // Date of Certification

        //<!-- Agreement -->

        // Fee Information
        $membersStore->defined_fee = $request->input('defined_fee');  // Defined Fee for arranging SIPP
        $membersStore->annual_fee_defined = $request->input('annual_fee_defined');  // Annual Fee for SIPP arrangement
        $membersStore->date_fee = $request->input('date_fee');  // Payment date for the defined fee

        $membersStore->percentage_fund = $request->input('percentage_fund');  // Percentage of Fund
        $membersStore->annual_fee_fund = $request->input('annual_fee_fund');  // Annual Fee for the fund
        $membersStore->date_fund = $request->input('date_fund');  // Payment date for the fund

        $membersStore->gross_contribution = $request->input('gross_contribution');  // Percentage of Gross Contribution
        $membersStore->annual_fee_gross = $request->input('annual_fee_gross');  // Annual Fee for gross contribution
        $membersStore->date_gross = $request->input('date_gross');  // Payment date for gross contributions

        // Transfer Related Fees
        $membersStore->transfer_value = $request->input('transfer_value');  // Value of Transfer
        $membersStore->fee_transfer = $request->input('fee_transfer');  // Fee for the transfer
        $membersStore->payment_received = $request->input('payment_received');  // Payment received date for the transfer

        // Apply for Future Transfers
        $membersStore->future_transfers = $request->input('future_transfers');  // Future transfers (Yes/No)

        // SIPP Member Section
        $membersStore->signature_member = $request->input('signature_member');  // SIPP Member's Signature
        $membersStore->print_name_member = $request->input('print_name_member');  // SIPP Member's Printed Name
        $membersStore->date_member = $request->input('date_member');  // SIPP Member's Signature Date

        $membersStore->adviser_network = $request->input('adviser_network');  // Adviser network (Yes/No)
        $membersStore->name_of_network = $request->input('name_of_network');  // Name of network
        $membersStore->network_payment = $request->input('network_payment');  // Network payment option (Yes/No)

        // Payment Information

        $membersStore->bank_name = $request->input('bank_name');  // Bank name
        $membersStore->branch = $request->input('branch');  // Branch name
        $membersStore->account_name = $request->input('account_name');  // Account name
        $membersStore->account_number = $request->input('account_number');  // Account number
        $membersStore->sort_code = $request->input('sort_code');  // Sort code

        // Adviser Information
        $membersStore->signature_adviser = $request->input('signature_adviser');  // Adviser signature
        $membersStore->name_adviser = $request->input('name_adviser');  // Adviser name
        $membersStore->position_adviser = $request->input('position_adviser');  // Adviser's position
        $membersStore->date_adviser = $request->input('date_adviser');  // Date of signature
        $membersStore->company_stamp = $request->input('company_stamp');  //

        // Pension Scheme Information
        $membersStore->pension_scheme_type = $request->pension_scheme_type;  // Type of pension scheme

        $membersStore->pension_scheme_name = $request->pension_scheme_name;  // Pension scheme name

        $membersStore->pension_provider_name = $request->pension_provider_name;  // Pension provider name
        $membersStore->professional_trustee_address = $request->professional_trustee_address;  // Trustee address
        $membersStore->scheme_admin_address = $request->scheme_admin_address;  // Scheme admin address
        $membersStore->employer_pay_premiums = $request->employer_pay_premiums;  // Employer pays premiums (Yes/No)
        $membersStore->hmrc_registration_number = $request->hmrc_registration_number;  // HMRC registration number
        $membersStore->alt_scheme_admin_address = $request->alt_scheme_admin_address;  // Alternate scheme admin address
        $membersStore->statements_required = $request->statements_required;  // Statements required (Yes/No)


        $membersStore->amount_to_be_deposited = $request->input('amount_to_be_deposited');  // Amount to be deposited
        $membersStore->term_months = $request->input('term_months');  // Term in months

        // Mandate Information
        $membersStore->professional_trustee_only = $request->input('professional_trustee_only');  // Professional trustee only
        $membersStore->authorised_signatories = $request->input('authorised_signatories');  // Authorised signatories
        $membersStore->signing_instructions = $request->input('signing_instructions');  // Signing instructions

        // Privacy Notices
        $membersStore->fraud_prevention = $request->fraud_prevention;  // Fraud prevention
        $membersStore->declaration = $request->declaration;  // Declaration
        $membersStore->certification = $request->certification;  // Certification


        // Professional Adviser Details
        $membersStore->company_name = $request->input('company_name');  // Company name
        $membersStore->company_address = $request->input('company_address');  // Company address
        $membersStore->company_post_code = $request->input('company_post_code');  // Post code
        $membersStore->company_telephone = $request->input('company_telephone');  // Telephone number
        $membersStore->contact_person = $request->input('contact_person');  // Contact person
        $membersStore->contact_email = $request->input('contact_email');  // Contact email

        // Part 1: Personal Information
        $membersStore->part_one_surname = $request->input('part_one_surname');  // Surname
        $membersStore->given_name = $request->input('given_name');  // Given name
        $membersStore->additional_name = $request->input('additional_name');  // Additional or middle name
        $membersStore->honorific_title = $request->input('honorific_title');  // Title
        $membersStore->part_one_gender = $request->input('part_one_gender');  // Gender
        $membersStore->home_address = $request->input('home_address');  // Home address
        $membersStore->locality = $request->input('locality');  // Locality or city
        $membersStore->zip_code = $request->input('zip_code');  // ZIP or postal code
        $membersStore->region = $request->input('region');  // Region or state
        $membersStore->nation = $request->input('nation');  // Country of residence
        $membersStore->birth_date = $request->input('birth_date');  // Date of birth
        $membersStore->birthplace_city = $request->input('birthplace_city');  // City of birth
        $membersStore->birthplace_nation = $request->input('birthplace_nation');  // Country of birth

        // Part 2: Tax Information



        $membersStore->tin_number = $request->tin_number;  // Taxpayer Identification Number
        $membersStore->reason_b_explanation = $request->input('reason_b_explanation');  // Reason B explanation
        $membersStore->tax_residence_more_than_three = $request->input('tax_residence_more_than_three');  // More than three tax residences?
        $membersStore->confirm_all_residences = $request->input('confirm_all_residences');  // Confirm all tax residences included
        $membersStore->us_person = $request->input('us_person');  // US person (Yes/No)

        // Part 3: Residency Information
        $membersStore->residency_mismatch_reason = $request->input('residency_mismatch_reason');  // Reason for residency mismatch
        $membersStore->additional_details = $request->input('additional_details');  // Additional details (optional)
        $membersStore->tax_relief = $request->tax_relief;  // Additional details (optional)

        //        dd($request->date_of_birth);
        // Part 4: Signature Information
        $membersStore->part_four_signature = $request->input('part_four_signature');  // Signature
        $membersStore->signature_print_name = $request->input('signature_print_name');  // Print name
        $membersStore->sign_day = $request->input('sign_day');  // Day of signing
        $membersStore->sign_month = $request->input('sign_month');  // Month of signing
        $membersStore->sign_year = $request->input('sign_year');  // Year of signing
        $membersStore->capacity = $request->input('capacity');  // Capacity of signatory

        $membersStore->signature_date = $request->signature_date;  // Capacity of signatory
   
        $membersStore->member_title = json_encode($request->member_title);
        $membersStore->first_name = json_encode($request->first_name);
        $membersStore->middle_name = json_encode($request->middle_name);
        $membersStore->date_of_birth = json_encode($request->date_of_birth);  // Date of birth
        $membersStore->tanee_member_gender = json_encode($request->tanee_member_gender);  // Gender
        $membersStore->member_nationality = json_encode($request->member_nationality);  // Nationality
        $membersStore->member_surname = json_encode($request->member_surname);  // Nationality
        $membersStore->country_of_birth = json_encode($request->country_of_birth);  // Country of birth
        $membersStore->home_telephone_number = json_encode($request->home_telephone_number);  // Home telephone number
        $membersStore->mobile_number = json_encode($request->mobile_number);  // Mobile number
        $membersStore->member_email_address = json_encode($request->member_email_address);  // Email address
        $membersStore->current_address = json_encode($request->current_address);  // Current address
        $membersStore->date_moved_in = json_encode($request->date_moved_in);  // Date moved in
        $membersStore->member_statements_required = json_encode($request->member_statements_required);  // Statements required (Yes/No)
        $membersStore->is_member_trustee = json_encode($request->is_member_trustee);  // Is member a trustee? (Yes/No)
        $membersStore->is_online_banking_required = json_encode($request->is_online_banking_required);  // Online banking (Yes/No)
        $membersStore->fixed_term_savings_sipp_ssas_account = json_encode($request->fixed_term_savings_sipp_ssas_account);  // Online banking (Yes/No)



        // Member Trustee Information
        $membersStore->trustee_name = json_encode($request->trustee_name);  // Trustee name
        $membersStore->trustee_signature = json_encode($request->trustee_signature);  // Trustee signature
        $membersStore->trustee_date = json_encode($request->trustee_date);  // Date of trustee signature
        $membersStore->sipp_ssas_account = json_encode($request->sipp_ssas_account);  // Date of trustee signature
        $membersStore->cheque_book_required = json_encode($request->cheque_book_required);  // Date of trustee signature;

        $membersStore->tax_residence_country = json_encode($request->tax_residence_country);  // Country of tax residence

        $membersStore->tin_reason = json_encode($request->tin_reason);  // Reason for not having a TIN
        $membersStore->tin_number = json_encode($request->tin_number);  // Reason for not having a TIN

        $membersStore->gender = json_encode($request->gender);
        $membersStore->marital_status = json_encode($request->marital_status);
        $membersStore->protection_type = json_encode($request->protection_type);
        
        $membersStore->privacy_print_name = json_encode($request->privacy_print_name);
        $membersStore->privacy_signature = json_encode($request->privacy_signature);
        $membersStore->privacy_position = json_encode($request->privacy_position );
        $membersStore->privacy_date = json_encode($request->privacy_date);


        
        
        $membersStore->funds_deposited_by = json_encode($request->funds_deposited_by);
        $membersStore->fees_paid_by = json_encode($request->fees_paid_by);
        $membersStore->controller_names = json_encode($request->controller_names);
        $membersStore->controller_dobs = json_encode($request->controller_dobs);
        $membersStore->beneficial_owner_names = json_encode($request->beneficial_owner_names);
        $membersStore->beneficial_owner_dobs = json_encode($request->beneficial_owner_dobs);
        $membersStore->investment_details = json_encode($request->investment_details);
        $membersStore->beneficiary_name = json_encode($request->beneficiary_name);  // Name of the beneficiary or charity
        
         $membersStore->charity_name = json_encode($request->charity_name);  // Name of the beneficiary or charity
          $membersStore->charity_percentage = json_encode($request->charity_percentage);  // Name of the beneficiary or charity
         
        $membersStore->relationship = json_encode($request->beneficiary_relationship);  // Relationship (only for beneficiaries)
        $membersStore->status = 'pending';
        $membersStore->percentage = json_encode($request->beneficiary_percentage);

      
        
        $membersStore->save();
        
         if ($userMember->email_notification === 'yes') {
        $username = $userMember->name;
        $userEmail = $userMember->email;
        $link = 'https://newalltrust.ilcorpdev.com/members-oasis-edit/{{$membersStore->id}}';
       
        $messageContent = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Alltrust Application Received – Next Steps</h2>
                <p>Dear {$username},</p>
                <p>Thank you for submitting your application to Alltrust Services Limited.</p>
                <p>To proceed, please log in to our portal to review and complete your application details.</p>
                <p>Click the link below to access your account: (Attachment 05).</p>
                <p>To log in, please use the details below:</p>
                <p>Portal Link: <a href='#' target='_blank' style='color: #007bff; text-decoration: none;'>Click Here</a></p>
                <p>Username: </p>
                <p>Temporary Password: </p>
                <p>For security purposes, please log in as soon as possible and update your password.</p>
                <p>If you encounter any issues or have questions, feel free to contact our IT support team at <a href='mailto:portalsupport@alltrust.co.uk' style='color: #007bff; text-decoration: none;'>portalsupport@alltrust.co.uk</a>.</p>
                <p>You will need to review the information in the application and electronically sign within our secure environment and submit the application. Please complete this link to the Alltrust ID Pal to upload your proof of identification and address so that we can process your application quickly. This link is also available on our website next to the “Members Access” button.</p>
                <p>We look forward to progressing your application and will keep you updated every step of the way.</p>
                <p>Best regards,<br>The Alltrust Team</p>
            </div>


        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
         }
        
        
        $admin = User::where('role','admin')->first();
        if ($admin->email_notification === 'yes') {
        
        $username = $admin->name;
        $userEmail = $admin->email;
       
        $messageContent = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Member Application Submission Alert</h2>
                <p>Dear New Business Team,</p>
                <p>We have received a new application submission via the online portal. Please review the details at your earliest convenience.</p>
                <p>To access the application, click the link below:</p>
                <p><a href='#' target='_blank' style='color: #007bff; text-decoration: none;'>View Application</a></p>
                <p>Please liaise with the adviser and/or member directly with any questions or clarity required to complete the review process.</p>
                <p>Best regards,<br>The Alltrust Team</p>
            </div>



        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
        }
        
        
        if(auth()->user()->role == 'onshore' || auth()->user()->role == 'offshore'){
            
        $advisoruser = User::find(auth()->user()->id);
        if ($advisoruser->email_notification === 'yes') {
        
                $username = $advisoruser->name;
        $userEmail = $advisoruser->email;
       
        $messageContent = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Alltrust Member Application</h2>
                <p>Dear {$username},</p>
                <p>Thank you for submitting a new member application.</p>
                <p>Our team will review the application promptly, and we will contact you if any additional information is required.</p>
                <p>In the meantime, if you have any questions or need further assistance, please contact us at 
                    <a href='mailto:newbusiness@alltrust.co.uk' style='color: #007bff; text-decoration: none;'>newbusiness@alltrust.co.uk</a>.
                </p>
                <p>Best regards,</p>
                <br>
                <h2 style='color: #333;'>Staff Registration</h2>
                <p>Portal Access Details</p>
                <p>Dear {$staff_name},</p>
                <p>Welcome to Alltrust Online!</p>
                <p>To log in, please use the details below:</p>
                <p>Portal Link: <a href='#' target='_blank' style='color: #007bff; text-decoration: none;'>[Insert Link Here]</a></p>
                <p>Username: [Your Email Address or Username]</p>
                <p>Temporary Password: [Insert Temporary Password]</p>
                <p>For security purposes, please log in as soon as possible and update your password.</p>
                <p>If you encounter any issues or have questions, feel free to contact our IT support team at 
                    <a href='mailto:portalsupport@alltrust.co.uk' style='color: #007bff; text-decoration: none;'>portalsupport@alltrust.co.uk</a>.
                </p>
                <p>Best regards,</p>
            </div>


        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
        }
        }

        return redirect()->back();
    }

    public function  memberedit($id, $source = 'existing')
    {
        $memberOasis = User::where('role', 'oasis_sipp')->get();
        
         $editMember = Member::with('user')->find($id);
       
         $user = User::find($editMember->role);
         
    //          $editMember->privacy_print_name = json_decode($editMember->privacy_print_name, true) ?? [];
    // $editMember->privacy_signature = json_decode($editMember->privacy_signature, true) ?? [];
    // $editMember->privacy_position = json_decode($editMember->privacy_position, true) ?? [];
    // $editMember->privacy_date = json_decode($editMember->privacy_date, true) ?? [];

        //  dd($user);  
     
        return view('dashboard.member.editOasisSipp', compact('editMember', 'memberOasis', 'source','user'));
    }
    public function memberUpdate(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->user_id);
        
    //   dd($user);
            $user->name = $request->user_name;
            $user->email = $request->user_email;
            $user->save();
            
            
        $member_id = $request->member_id;
        $member = Member::findOrFail($member_id);
        $member->role = $request->role;
         $member->creater_id = $request->creater_id;
        $member->forename = $request->input('forename');  // Forename
        $member->surname = $request->input('surname');  // Surname
        $member->address = $request->input('address');  // Residential Address
        $member->country = $request->input('country');  // Country
        $member->postcode = $request->input('postcode');  // Postcode
        $member->telephone = $request->input('telephone');  // Telephone Number
        $member->email = $request->input('email');  // Email Address

        $member->nationality = $request->input('nationality');  // Nationality or Citizenship
        $member->dob = $request->input('dob');  // Date of Birth

        $member->spouse_dob = $request->input('spouse_dob');  // Spouse's Date of Birth
        $member->pension_order = $request->input('pension_order');  // Pension Sharing or Pension Earmarking Order (Yes/No)
        $member->occupation = $request->input('occupation');  // Occupation
        $member->employment_status = $request->input('employment_status');  // Employment Status
        $member->opted_out = $request->opted_out;  // Opted Out of Pension Arrangement (Yes/No)
        $member->pension_protection = $request->pension_protection;  // Protection of Existing Pension Rights (Yes/No)

        $member->annual_allowance = $request->annual_allowance;  // Annual Allowance (Yes/No)
        $member->first_payment_date = $request->first_payment_date;

        //<!-- contribution -->

        $member->contribute_regular_contribution = $request->contribute_regular_contribution;  // Regular Contribution
        $member->contribute_single_contribution = $request->contribute_single_contribution;  // Single Contribution
        $member->payment_frequency = $request->payment_frequency;  // Payment Frequency (e.g., Monthly, Quarterly)
        $member->employer_pay = $request->employer_pay;  // Whe

        //<!-- employer detail -->

        $member->employer_name = $request->input('employer_name');  // Employer's name
        $member->registered_office = $request->input('registered_office');  // Registered office address
        $member->employee_postcode = $request->input('employee_postcode');  // Postcode
        $member->telephone_number = $request->input('telephone_number');  // Telephone number (including area code)
        $member->employee_contact_name = $request->input('employee_contact_name');  // Contact person's name
        $member->email_address = $request->input('email_address');  // Email address
        $member->trading_address = $request->input('trading_address');  // Trading address (if different from registered office)
        $member->trading_postcode = $request->input('trading_postcode');  // Postcode for trading address
        $member->fax_number = $request->input('fax_number');  // Fax number (including area code)
        $member->additional_telephone = $request->input('additional_telephone');  // Additional telephone number

        //<!-- employer contribution -->

        $member->regular_contribution = $request->input('regular_contribution');  // Regular contribution provided by the employer
        $member->single_contribution = $request->input('single_contribution');  // Single contribution provided by the employer
        $member->payment_frequency = $request->input('payment_frequency');  // Frequency of regular contributions (e.g., Monthly, Quarterly)
        $member->start_date = $request->input('start_date');  // Start date

        //<!-- employee declaration -->

        $member->signature = $request->input('signature');  // Signature of the authorised signatory
        $member->print_name = $request->input('print_name');  // Print name of the authorised signatory
        $member->position = $request->input('position');  // Position of the authorised signatory
        $member->date = $request->input('date');  // D

        //<!-- financial adviser -->

        $member->financial_contact_name = $request->input('financial_contact_name');  // Contact name of the adviser
        $member->financial_company_name = $request->input('financial_company_name');  // Company name of the adviser
        $member->street_address = $request->input('street_address');  // Street address
        $member->city = $request->input('city');  // City
        $member->financial_postcode = $request->input('financial_postcode');  // Postcode
        $member->financial_telephone_number = $request->input('financial_telephone_number');  // Telephone number
        $member->financial_fax_number = $request->input('financial_fax_number');  // Fax number
        $member->financial_email_address = $request->input('financial_email_address');  // Email address
        $member->regulated_by = $request->input('regulated_by');  // Authority regulating the adviser
        $member->authorisation_number = $request->input('authorisation_number');  // Authorisation number
        $member->network_status = $request->input('network_status');  // Whether part of a network (Yes/No)
        $member->network_name = $request->input('network_name');  // Name of the network
        $member->regulated_by_second = $request->input('regulated_by_second');  // Regulated by (second time)
        $member->company_authorisation_number = $request->input('company_authorisation_number');  // Company authorisation number

        //<!-- beneficiries -->


        $member->type = $request->input('type');  // Typ

        //<!-- investment -->

        $member->investment_option = $request->input('investment_option');  // Full or Single Investment

        $member->contact_name = $request->input('contact_name');  // Contact name of the investment manager
        $member->investment_company_name = $request->input('investment_company_name');  // Company name of the investment manager
        $member->investment_address = $request->input('investment_address');  // Address
        $member->investment_postcode = $request->input('investment_postcode');  // Postcode
        $member->investment_telephone_number = $request->input('investment_telephone_number');  // Telephone number
        $member->investment_fax_number = $request->input('investment_fax_number');  // Fax number
        $member->investment_email_address = $request->input('investment_email_address');  // Email address
        $member->plan_type = $request->input('plan_type');  // Plan type

        //<!-- benefits -->

        // Assign the request inputs to the respective fields in the model
        $member->take_benefits_soon = $request->input('take_benefits_soon');  // Whether the user intends to take benefits soon
        $member->benefits_method = $request->input('benefits_method');  // Method of taking benefits
        $member->benefit_start_date = $request->input('benefit_start_date');

        //<!-- other benefits -->

        $member->provider_name = $request->input('provider_name');  // Provider's Full Name
        $member->other_benefits_address = $request->input('other_benefits_address');  // Address
        $member->other_benefits_postcode = $request->input('other_benefits_postcode');  // Postcode
        $member->other_telephone_number = $request->input('other_telephone_number');  // Telephone Number
        $member->other_fax_number = $request->input('other_fax_number');  // Fax Number
        $member->other_email_address = $request->input('other_email_address');  // Email Address
        $member->plan_scheme_type = $request->input('plan_scheme_type');  // Plan/Scheme Type
        $member->is_occupational_scheme = $request->input('is_occupational_scheme');  // Is this an occupational scheme?
        $member->plan_scheme_name = $request->input('plan_scheme_name');  // Plan/Scheme Name
        $member->pension_scheme_tax_reference = $request->input('pension_scheme_tax_reference');  // Pension Scheme Tax Reference
        $member->fund_value = $request->input('fund_value');  // Value of Fund to be Transferred
        $member->full_value_scheme = $request->input('full_value_scheme');  // Does this represent the full value of the current plan/scheme?
        $member->funds_crystallised = $request->input('funds_crystallised');  // Have any funds been crystallised?
        $member->crystallised_method = $request->input('crystallised_method');  // Crystallisation method
        $member->other_signature = $request->input('other_signature');  // Signature
        $member->other_print_name = $request->input('other_print_name');  // Print Name
        $member->other_date = $request->input('other_date');

        //<!-- member constent -->

        // Member Consent Section

        $member->contact_consent = $request->input('contact_consent');  // Contact consent for products and services
        $member->passing_contact_consent = $request->input('passing_contact_consent');  // Consent for passing contact to other subsidiaries
        $member->contact_method = $request->input('contact_method');  // Preferred contact method (email or post)

        // Signature, Name, and Date for Consent

        // Assign the request inputs to the respective fields in the model
        $member->signature_consent = $request->input('signature_consent');  // Signature for consent
        $member->signatur_print_name = $request->input('signatur_print_name');  // Printed name for consent
        $member->date = $request->input('date');  // Da

        // Member Declaration Section

        $member->signature_declaration = $request->input('signature_declaration');  // Signature for declaration
        $member->print_name_declaration = $request->input('print_name_declaration');  // Printed name for declaration
        $member->position_declaration = $request->input('position_declaration');  // Position of the person signing the declaration
        $member->declaration_date = $request->input('declaration_date');

        //<!-- Corporate -->

        // Company Information

        $member->infor_company_name = $request->input('infor_company_name');  // Company Name
        $member->entity_type = $request->input('entity_type');  // Entity Type
        $member->registered_address = $request->input('registered_address');  // Registered Address
        $member->registered_number = $request->input('registered_number');  // Registered Number
        $member->infor_country = $request->input('infor_country');  // Country
        $member->company_info_postcode = $request->input('company_info_postcode');  // Postcode
        $member->nature_of_business = $request->input('nature_of_business');  // Nature of Business

        // Control Information

        $member->individual_verification = $request->input('individual_verification');


        $member->beneficial_verification = $request->input('beneficial_verification');  // Beneficial owner verification (Yes/No)

        // Certification Information
        $member->standard_verification = $request->input('standard_verification');  // Standard verification (Yes/No)
        $member->confirmation_letter = $request->input('confirmation_letter');  // Confirmation letter (Yes/No)
        $member->open_account = $request->input('open_account');  // Open account (Yes/No)

        // Signature Information
        $member->name_of_regulated_firm = $request->input('name_of_regulated_firm');  // Name of the regulated firm
        $member->regulator_name_reference = $request->input('regulator_name_reference');  // Regulator's name and reference
        $member->regulated_individual_name = $request->input('regulated_individual_name');  // Name of the regulated individual
        $member->regulated_individual_reference = $request->input('regulated_individual_reference');  // Reference of the regulated individual
        $member->signature_segnature = $request->input('signature_segnature');  // Signature
        $member->regulated_name = $request->input('regulated_name');  // Name of the signatory
        $member->regulated_position = $request->input('regulated_position');  // Position of the signatory
        $member->regulated_date = $request->input('regulated_date');


        // Applicant Information
        $member->applicant_name = $request->input('applicant_name');  // Applicant's Name
        $member->application_dob = $request->input('application_dob');  // Applicant's Date of Birth
        $member->applicant_address = $request->input('applicant_address');  // Applicant's Address
        $member->application_country = $request->input('application_country');  // Applicant's Country
        $member->applicant_info_postcode = $request->input('applicant_info_postcode');  // Applicant's Postcode

        // Previous Address Information (if changed)
        $member->changed_address = $request->input('changed_address');  // Previous Address (if changed)
        $member->previous_country = $request->input('previous_country');  // Previous Country (if changed)
        $member->previous_postcode = $request->input('previous_postcode');  // Previous Postcode (if changed)

        // Certification Information
        $member->regulator_firm_name = $request->input('regulator_firm_name');  // Regulator Firm Name
        $member->regulator_reference = $request->input('regulator_reference');  // Regulator Reference
        $member->regulated_cer_individual_name = $request->input('regulated_cer_individual_name');  // Regulated Individual's Name
        $member->regulated_certification_individual_reference = $request->input('regulated_certification_individual_reference');  // Regulated Individual's Reference
        $member->certification_signature = $request->input('certification_signature');  // Signature
        $member->certification_name = $request->input('certification_name');  // Printed Name
        $member->certification_position = $request->input('certification_position');  // Position
        $member->certification_date = $request->input('certification_date');  // Date of Certification

        //<!-- Agreement -->

        // Section One - Initial and ongoing fees
        // Fee Information
        $member->defined_fee = $request->input('defined_fee');  // Defined Fee for arranging SIPP
        $member->annual_fee_defined = $request->input('annual_fee_defined');  // Annual Fee for SIPP arrangement
        $member->date_fee = $request->input('date_fee');  // Payment date for the defined fee

        $member->percentage_fund = $request->input('percentage_fund');  // Percentage of Fund
        $member->annual_fee_fund = $request->input('annual_fee_fund');  // Annual Fee for the fund
        $member->date_fund = $request->input('date_fund');  // Payment date for the fund

        $member->gross_contribution = $request->input('gross_contribution');  // Percentage of Gross Contribution
        $member->annual_fee_gross = $request->input('annual_fee_gross');  // Annual Fee for gross contribution
        $member->date_gross = $request->input('date_gross');  // Payment date for gross contributions

        // Transfer Related Fees
        $member->transfer_value = $request->input('transfer_value');  // Value of Transfer
        $member->fee_transfer = $request->input('fee_transfer');  // Fee for the transfer
        $member->payment_received = $request->input('payment_received');  // Payment received date for the transfer

        // Apply for Future Transfers
        $member->future_transfers = $request->input('future_transfers');  // Future transfers (Yes/No)

        // SIPP Member Section
        $member->signature_member = $request->input('signature_member');  // SIPP Member's Signature
        $member->print_name_member = $request->input('print_name_member');  // SIPP Member's Printed Name
        $member->date_member = $request->input('date_member');  // SIPP Member's Signature Date

        $member->adviser_network = $request->input('adviser_network');  // Adviser network (Yes/No)
        $member->name_of_network = $request->input('name_of_network');  // Name of network
        $member->network_payment = $request->input('network_payment');  // Network payment option (Yes/No)

        // Payment Information

        $member->bank_name = $request->input('bank_name');  // Bank name
        $member->branch = $request->input('branch');  // Branch name
        $member->account_name = $request->input('account_name');  // Account name
        $member->account_number = $request->input('account_number');  // Account number
        $member->sort_code = $request->input('sort_code');  // Sort code

        // Adviser Information
        $member->signature_adviser = $request->input('signature_adviser');  // Adviser signature
        $member->name_adviser = $request->input('name_adviser');  // Adviser name
        $member->position_adviser = $request->input('position_adviser');  // Adviser's position
        $member->date_adviser = $request->input('date_adviser');  // Date of signature
        $member->company_stamp = $request->input('company_stamp');  //

        // Pension Scheme Information
        $member->pension_scheme_type = $request->pension_scheme_type;  // Type of pension scheme

        $member->pension_scheme_name = $request->pension_scheme_name;  // Pension scheme name

        $member->pension_provider_name = $request->pension_provider_name;  // Pension provider name
        $member->professional_trustee_address = $request->professional_trustee_address;  // Trustee address
        $member->scheme_admin_address = $request->scheme_admin_address;  // Scheme admin address
        $member->employer_pay_premiums = $request->employer_pay_premiums;  // Employer pays premiums (Yes/No)
        $member->hmrc_registration_number = $request->hmrc_registration_number;  // HMRC registration number
        $member->alt_scheme_admin_address = $request->alt_scheme_admin_address;  // Alternate scheme admin address
        $member->statements_required = $request->statements_required;  // Statements required (Yes/No)


        $member->amount_to_be_deposited = $request->input('amount_to_be_deposited');  // Amount to be deposited
        $member->term_months = $request->input('term_months');  // Term in months

        // Mandate Information
        $member->professional_trustee_only = $request->input('professional_trustee_only');  // Professional trustee only
        $member->authorised_signatories = $request->input('authorised_signatories');  // Authorised signatories
        $member->signing_instructions = $request->input('signing_instructions');  // Signing instructions

        // Privacy Notices
        $member->fraud_prevention = $request->fraud_prevention;  // Fraud prevention
        $member->declaration = $request->declaration;  // Declaration
        $member->certification = $request->certification;  // Certification


        // Professional Adviser Details
        $member->company_name = $request->input('company_name');  // Company name
        $member->company_address = $request->input('company_address');  // Company address
        $member->company_post_code = $request->input('company_post_code');  // Post code
        $member->company_telephone = $request->input('company_telephone');  // Telephone number
        $member->contact_person = $request->input('contact_person');  // Contact person
        $member->contact_email = $request->input('contact_email');  // Contact email

        // Part 1: Personal Information
        $member->part_one_surname = $request->input('part_one_surname');  // Surname
        $member->given_name = $request->input('given_name');  // Given name
        $member->additional_name = $request->input('additional_name');  // Additional or middle name
        $member->honorific_title = $request->input('honorific_title');  // Title
        $member->part_one_gender = $request->input('part_one_gender');  // Gender
        $member->home_address = $request->input('home_address');  // Home address
        $member->locality = $request->input('locality');  // Locality or city
        $member->zip_code = $request->input('zip_code');  // ZIP or postal code
        $member->region = $request->input('region');  // Region or state
        $member->nation = $request->input('nation');  // Country of residence
        $member->birth_date = $request->input('birth_date');  // Date of birth
        $member->birthplace_city = $request->input('birthplace_city');  // City of birth
        $member->birthplace_nation = $request->input('birthplace_nation');  // Country of birth

        // Part 2: Tax Information



        $member->tin_number = $request->tin_number;  // Taxpayer Identification Number
        $member->reason_b_explanation = $request->input('reason_b_explanation');  // Reason B explanation
        $member->tax_residence_more_than_three = $request->input('tax_residence_more_than_three');  // More than three tax residences?
        $member->confirm_all_residences = $request->input('confirm_all_residences');  // Confirm all tax residences included
        $member->us_person = $request->input('us_person');  // US person (Yes/No)

        // Part 3: Residency Information
        $member->residency_mismatch_reason = $request->input('residency_mismatch_reason');  // Reason for residency mismatch
        $member->additional_details = $request->input('additional_details');  // Additional details (optional)
        $member->tax_relief = $request->tax_relief;  // Additional details (optional)

        //        dd($request->date_of_birth);
        // Part 4: Signature Information
        $member->part_four_signature = $request->input('part_four_signature');  // Signature
        $member->signature_print_name = $request->input('signature_print_name');  // Print name
        $member->sign_day = $request->input('sign_day');  // Day of signing
        $member->sign_month = $request->input('sign_month');  // Month of signing
        $member->sign_year = $request->input('sign_year');  // Year of signing
        $member->capacity = $request->input('capacity');  // Capacity of signatory

        $member->signature_date = $request->signature_date;  // Capacity of signatory
        //        dd($request->signature_date);
        //        dd($request->all());

        $member->first_name = json_encode($request->first_name);
        $member->middle_name = json_encode($request->middle_name);
        $member->date_of_birth = json_encode($request->date_of_birth);  // Date of birth
        $member->tanee_member_gender = json_encode($request->tanee_member_gender);  // Gender
        $member->member_nationality = json_encode($request->member_nationality);  // Nationality
        $member->member_surname = json_encode($request->member_surname);  // Nationality
        $member->country_of_birth = json_encode($request->country_of_birth);  // Country of birth
        $member->home_telephone_number = json_encode($request->home_telephone_number);  // Home telephone number
        $member->mobile_number = json_encode($request->mobile_number);  // Mobile number
        $member->member_email_address = json_encode($request->member_email_address);  // Email address
        $member->current_address = json_encode($request->current_address);  // Current address
        $member->date_moved_in = json_encode($request->date_moved_in);  // Date moved in
        $member->member_statements_required = json_encode($request->member_statements_required);  // Statements required (Yes/No)
        $member->is_member_trustee = json_encode($request->is_member_trustee);  // Is member a trustee? (Yes/No)
        $member->is_online_banking_required = json_encode($request->is_online_banking_required);  // Online banking (Yes/No)
        $member->fixed_term_savings_sipp_ssas_account = json_encode($request->fixed_term_savings_sipp_ssas_account);  // Online banking (Yes/No)



        // Member Trustee Information
        $member->trustee_name = json_encode($request->trustee_name);  // Trustee name
        $member->trustee_signature = json_encode($request->trustee_signature);  // Trustee signature
        $member->trustee_date = json_encode($request->trustee_date);  // Date of trustee signature
        $member->sipp_ssas_account = json_encode($request->sipp_ssas_account);  // Date of trustee signature
        $member->cheque_book_required = json_encode($request->cheque_book_required);  // Date of trustee signature;

        $member->tax_residence_country = json_encode($request->tax_residence_country);  // Country of tax residence

        $member->tin_reason = json_encode($request->tin_reason);  // Reason for not having a TIN
        $member->tin_number = json_encode($request->tin_number);  // Reason for not having a TIN

        $member->gender = json_encode($request->gender);
        $member->marital_status = json_encode($request->marital_status);
        $member->protection_type = json_encode($request->protection_type);
        $member->privacy_print_name = json_encode($request->privacy_print_name);
        $member->privacy_signature = json_encode($request->privacy_signature);
        $member->privacy_position = json_encode($request->privacy_position);
        $member->privacy_date = json_encode($request->privacy_date);
        $member->funds_deposited_by = json_encode($request->funds_deposited_by);
        $member->fees_paid_by = json_encode($request->fees_paid_by);
        $member->controller_names = json_encode($request->controller_names);
        $member->controller_dobs = json_encode($request->controller_dobs);
        $member->beneficial_owner_names = json_encode($request->beneficial_owner_names);
        $member->beneficial_owner_dobs = json_encode($request->beneficial_owner_dobs);
        $member->investment_details = json_encode($request->investment_details);
        $member->beneficiary_name = json_encode($request->beneficiary_name);  // Name of the beneficiary or charity
        $member->relationship = json_encode($request->beneficiary_relationship);  // Relationship (only for beneficiaries)

        $member->percentage = json_encode($request->beneficiary_percentage);


        $member->save();
        


        return redirect()->back();
    }
    public function  memberViewSpecific($id, $source = 'existing')
    {
        $memberOasis = User::where('role', 'oasis_sipp')->get();
        $viewMember = Member::find($id);
        $userMember = Member::find($member->role);
        return view('dashboard.member.viewOasisSipp', compact('viewMember', 'memberOasis', 'source','userMember'));
    }

    public function destroys($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

 public function membersPending()
{
    // Get pending members with associated user information
    
    if(auth()->user()->role == 'admin'){
                $pendingMembers = Member::where('status', 'pending')->get();
                $fptPendingMembers = Fpt::where('status', 'pending')->get();
        }
        elseif(auth()->user()->role == 'oasis_sipp' || auth()->user()->role == 'sipp_property' || auth()->user()->role == 'full_sipp_property' || auth()->user()->role == 'fpt'){
            $pendingMembers = Member::where('status', 'pending')->where('role',auth()->user()->id)->get();
             $fptPendingMembers = Fpt::where('status', 'pending')->where('user_id',auth()->user()->id)->get();
        }
        
        else{
                $pendingMembers = Member::where('status', 'pending')->where('creater_id',auth()->user()->id)->get();
                $fptPendingMembers = Fpt::where('status', 'pending')->where('creater_id',auth()->user()->id )->get();
        }
    
   
//     $pendingMembers = Member::where('status', 'pending')->get();
//  $fptPendingMembers = Fpt::where('status', 'pending')->with('user')->get();

        
    //   dd($fptPendingMembers); 
        
    return view('dashboard.member.pendingApplications', compact('pendingMembers','fptPendingMembers'));
}


    public function memberExisting()
    {
        
        
        if(auth()->user()->role == 'admin'){
                $existingMembers = Member::where('status', 'active')->get();
                $fptActiveMembers = Fpt::where('status', 'active')->with('user')->get();
        }
        
         elseif(auth()->user()->role == 'oasis_sipp' || auth()->user()->role == 'sipp_property' || auth()->user()->role == 'full_sipp_property' || auth()->user()->role == 'fpt'){
             
              $existingMembers = Member::where('status', 'active')->where('role',auth()->user()->id)->get();
                $fptActiveMembers = Fpt::where('status', 'active')->where('user_id',auth()->user()->id )->get();
         }
        
        else{
                $existingMembers = Member::where('status', 'active')->where('creater_id',auth()->user()->id)->get();
                $fptActiveMembers = Fpt::where('status', 'active')->where('creater_id',auth()->user()->id )->get();
        }
        
        return view('dashboard.member.existingApplications', compact('existingMembers','fptActiveMembers'));
    }


public function pendingamember($id, $status) {
    $offmember = Member::find($id);

    if (!$offmember) {
        return redirect()->back()->with('error', 'Member not found.');
    }

    $offmember->status = $status;
    $offmember->save();


    $adminEmail = 'newbusiness@alltrust.co.uk';
    $adminMessage = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
            <h2 style='color: #333;'>Member Change Request Submitted</h2>
            <p>Dear Admin Team,</p>
            <p>This is to inform you that a member change request has been submitted and is now awaiting your review and action.</p>
            <p><strong>Member Name:</strong> {$offmember->name}</p>
            <p><strong>Request Type:</strong> Status Change</p>
            <p>Please click the link below to review the request:</p>
            <p><a href='#' target='_blank' style='color: #007bff; text-decoration: none;'>Review Request</a></p>
            <p>Best regards,<br>Alltrust Team</p>
        </div>
    ";
    Mail::to($adminEmail)->send(new SimpleMail($adminMessage));

    // Member Email
    if (!empty($offmember->email)) {
        $memberEmail = $offmember->email;
        $memberMessage = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Confirmation of Your Change Request</h2>
                <p>Dear {$offmember->name},</p>
                <p>Thank you for submitting your change request to the Alltrust admin team. We are pleased to confirm that your request has been successfully processed.</p>
                <p><strong>Request Type:</strong> Status Change</p>
                <p><strong>Effective Date:</strong> " . now()->format('Y-m-d') . "</p>
                <p>If you have any questions, please contact us at <a href='mailto:admin@alltrust.co.uk' style='color: #007bff; text-decoration: none;'>admin@alltrust.co.uk</a>.</p>
                <p>Best regards,<br>Alltrust Team</p>
            </div>
        ";
        Mail::to($memberEmail)->send(new SimpleMail($memberMessage));
    }

    return redirect()->back()->with('success', 'Status updated and emails sent.');
}



    public function membersDetails()
    {
        
        if(auth()->user()->role == 'admin' || auth()->user()->role == 'advisor_firm'){
                    $memberDetails = Member::where('status', 'active')->get();
                    $ftpmemberDetails = FPT::where('status', 'active')->get();
        }
         elseif(auth()->user()->role == 'oasis_sipp' || auth()->user()->role == 'sipp_property' || auth()->user()->role == 'full_sipp_property' || auth()->user()->role == 'fpt'){
                    $memberDetails = Member::where('status', 'active')->where('role',auth()->user()->id)->get();
                   $ftpmemberDetails = FPT::where('status', 'active')->where('user_id',auth()->user()->id)->get();
         }
        else{
                  $memberDetails = Member::where('status', 'active')->where('creater_id',auth()->user()->id)->get();
                   $ftpmemberDetails = FPT::where('status', 'active')->where('creater_id',auth()->user()->id)->get();
        }

    
        return view('dashboard.member.memberDetails', compact('memberDetails','ftpmemberDetails'));
    }

    
    public function addmembersDetails(){
         return view('dashboard.member.addmemberDetails');
    }
    
    public function membersDetailstore(Request $request){
        
        $member = Memberdetail::create($request->all());
        
         return redirect()->route('members-details');
}

    public function membersDetailsEdit($id)
    {
        $member = Member::find($id);
        return view('dashboard.member.memberDetailsEdit',compact('member'));
    }

    public function membersDetailsView($id)
    {
        $member = Member::find($id);
        return view('dashboard.member.memberDetailsView',compact('member'));
    }
    
        public function membersDetailsViewftp($id)
    {
        $member = FPT::find($id);
        return view('dashboard.member.memberDetailsView',compact('member'));
    }

    public function membersDetailsUpdate(Request $request, $id)
    {
        $member = Memberdetail::find($id);
        if ($member) {           
            $member->update($request->all());
             return redirect(route('members-details'))->with('success', 'Data Updated Siccessfully...');
        }
        return redirect()->back()->with('error', 'Failed to update the record!');
        
    }

    public function membersDetailsDelete($id)
    {
        $post = Memberdetail::find($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post soft deleted successfully.');
    }

    public function showDeletedMember()
    {
        $deletedMembers = Member::onlyTrashed()->get(); // Fetch soft deleted posts
        return view('dashboard.member.deletedMembers', compact('deletedMembers'));
    }

   // Restore deleted member
public function restoreMember($id)
{
    // Find the soft deleted member
    $member = Member::withTrashed()->find($id);

    if ($member) {
        // Restore the member
        $member->restore();

        // Redirect with success message
        return redirect()->back()->with('success', 'Member restored successfully');
    }

    // If member not found, return an error message
    return redirect()->back()->with('error', 'Member not found');
}

    
    public function destroy($id)
    {
        $member = Member::find($id);

        if ($member) {
            $member->delete(); // Soft delete the member
            return redirect()->back()->with('success', 'Member soft deleted successfully.');
        }

        return redirect()->back()->with('error', 'Member not found.');
    }

    // Fetch all soft deleted members
 // Fetch all soft deleted members
 public function deleted()
 {
      // Fetch all deleted advisers
        $deletedFpt = Fpt::onlyTrashed()->get();
     $deletedMembers = Member::onlyTrashed()->get(); // Fetch all deleted members
     return view('dashboard.member.deletemember', compact('deletedMembers','deletedFpt'));
 }
 
  public function declinedList()
  
 {
     $declinedMember = Member::where('status', 'decline')->get();
     $declinedFpt = FPT::where('status', 'decline')->get();
     
     if(auth()->user()->role = 'admin'){
         
     $declinedMember = Member::where('status', 'decline')->get();
     $declinedFpt = FPT::where('status', 'decline')->get();
     
     }
      elseif(auth()->user()->role == 'oasis_sipp' || auth()->user()->role == 'sipp_property' || auth()->user()->role == 'full_sipp_property' || auth()->user()->role == 'fpt'){
          
          $declinedMember = Member::where('status', 'decline')->where('role',auth()->user()->id)->get();
          $declinedFpt = FPT::where('status', 'decline')->where('user_id',auth()->user()->id)->get();
      }
      else{
          $declinedMember = Member::where('status', 'decline')->where('creater_id',auth()->user()->id)->get();
          $declinedFpt = FPT::where('status', 'decline')->where('creater_id',auth()->user()->id)->get();
      }

     // Pass both variables to the view
     return view('dashboard.member.declinedApplication', compact('declinedMember', 'declinedFpt'));
 }

    public function membersBefore() {
        
        return view('dashboard.member.memberbefore');
    }
    
    public function membersBefore2() {
        
        return view('dashboard.member.memberbefore2');
    }
    
    public function membersBefore3() {
        
        return view('dashboard.member.memberbefore3');
    }


}
