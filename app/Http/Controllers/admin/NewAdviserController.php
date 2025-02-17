<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Advisers;
use App\Models\Offshore;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SimpleMail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class NewAdviserController extends Controller
{

    public function create()
    {
        $advisers = User::where('role', 'onshore_adviser')->get();
        $ad_role_mem = 'onshore_adviser';
        return view('dashboard.adviser.newAdviser.newAdviser', compact('advisers','ad_role_mem'));
    }
   

    public function store(Request $request)
    {
 
    // Save the data after validation
    $ad_role_mem = new User();
    $ad_role_mem->name = $request->user_name;
    $ad_role_mem->creator_id = auth()->user()->id;   
    $ad_role_mem->email = $request->user_email;
    $ad_role_mem->password = Hash::make('12345678');
    $ad_role_mem->role = $request->role_member;
    
    
        $ad_role_mem->adviser_check = 'adviser_check';
    // $ad_role_mem->adviser_pending = 'adviser_pending';
    // $ad_role_mem->adviser_existing = 'adviser_existing';
    // $ad_role_mem->adviser_declined = 'adviser_declined';
    
    $ad_role_mem->offshore_check = 'offshore_check';
    // $ad_role_mem->offshore_pending = 'offshore_pending';
    // $ad_role_mem->offshore_existing = 'offshore_existing';
    // $ad_role_mem->offshore_declined = 'offshore_declined';
    
    $ad_role_mem->oasis_sipp__check = 'oasis_sipp__check';
    $ad_role_mem->sipp_property_check = 'sipp_property_check';
    $ad_role_mem->full_sipp_check = 'full_sipp_check';
    $ad_role_mem->ftp_check = 'ftp_check';
    $ad_role_mem->pending_applications = 'pending_applications';
    $ad_role_mem->existing_applications = 'existing_applications';
    $ad_role_mem->decline_applications = 'decline_applications';
    $ad_role_mem->tickets_check = 'tickets_check';
    $ad_role_mem->support_check = 'support_check';
    $ad_role_mem->faq_check = 'faq_check';
    $ad_role_mem->save();

        // Create a new Adviser instance
        $adviser = new Advisers();
        $adviser->selected_adviser_id = $ad_role_mem->id;
         $adviser->creater_id = auth()->user()->id;
        $adviser->company_name = $request->company_name;
        $adviser->trading_name = $request->trading_name;
        $adviser->address = $request->address;
        $adviser->country = $request->country;
        $adviser->post_code = $request->post_code;
        $adviser->share_holder_details = $request->share_holder_details;
        $adviser->regulated_adviser = $request->regulated_adviser;
        $adviser->contact_email = $request->contact_email;
        $adviser->website = $request->website;
        $adviser->telephone = $request->telephone;
        $adviser->fca_firms_reference = $request->fca_firms_reference;
        $adviser->directly_authorised_checked = $request->directly_authorised_checked;
        $adviser->appointed_representative_checked = $request->appointed_representative_checked;
        $adviser->principal_company_name = $request->principal_company_name;
        $adviser->their_frn = $request->their_frn;
        $adviser->advice = $request->advice;
        $adviser->provide_countries = $request->provide_countries;
        $adviser->hear_about_us = $request->hear_about_us;
        $adviser->word_of_referrals_checked = $request->word_of_referrals_checked;
        $adviser->lead_generation_checked = $request->lead_generation_checked;
        $adviser->marketing_checked = $request->marketing_checked;
        $adviser->other_specify_checked = $request->other_specify_checked;
        $adviser->other_specify = $request->other_specify;
        $adviser->restrictions_yes_permission = $request->restrictions_yes_permission;
        $adviser->restrictions_yes_permission_answer = $request->restrictions_yes_permission_answer;
        $adviser->sanctions = $request->sanctions;
        $adviser->sanctions_yes_answer = $request->sanctions_yes_answer;
        $adviser->connection_connection = $request->connection_connection;
        $adviser->connection_connection_yes_answer = $request->connection_connection_yes_answer;
        $adviser->professional_indemnity_insurance = $request->professional_indemnity_insurance;
        $adviser->policy_excess_DB = $request->policy_excess_DB;
        $adviser->other_money = $request->other_money;
        $adviser->separate_cyber_security = $request->separate_cyber_security;
        $adviser->permissions_for_advising = $request->permissions_for_advising;
        $adviser->initial_advice_fee = $request->initial_advice_fee;
        $adviser->going_annual_fee = $request->going_annual_fee;
        $adviser->house_portfolio_solutions = $request->house_portfolio_solutions;
        $adviser->receive_provider_commission = $request->receive_provider_commission;
        $adviser->investment_strategy = json_encode($request->investmentStrategy);
        $adviser->typical_investment_strategy = $request->typical_investment_strategy;
        $adviser->running_managing_portfolios = $request->running_managing_portfolios;
        $adviser->basis = $request->basis;
        $adviser->principal_company_name1 = $request->principal_company_name1;
        $adviser->principal_company_name2 = $request->principal_company_name2;
        $adviser->principal_company_name3 = $request->principal_company_name3;
        $adviser->principal_company_name4 = $request->principal_company_name4;
        $adviser->account_name = $request->account_name;
        $adviser->bank_name = $request->bank_name;
        $adviser->account_number = $request->account_number;
        $adviser->sort_code = $request->sort_code;
        $adviser->not_applicable = $request->not_applicable;
        $adviser->advisers_permitted = $request->advisers_permitted;
        $adviser->staff_supervisory_position = $request->staff_supervisory_position;
        $adviser->gold_standard = $request->gold_standard;
        $adviser->db_transfers_12_months = $request->db_transfers_12_months;
        $adviser->total_value_12_months = $request->total_value_12_months;
        $adviser->percentage_db_transfers_12_months = $request->percentage_db_transfers_12_months;
        $adviser->db_transfers_24_months = $request->db_transfers_24_months;
        $adviser->total_value_24_months = $request->total_value_24_months;
        $adviser->percentage_db_transfers_24_months = $request->percentage_db_transfers_24_months;
        $adviser->db_transfers_36_months = $request->db_transfers_36_months;
        $adviser->total_value_36_months = $request->total_value_36_months;
        $adviser->percentage_db_transfers_36_months = $request->percentage_db_transfers_36_months;
        $adviser->complaints_12_months = $request->complaints_12_months;
        $adviser->redress_cases_12_months = $request->redress_cases_12_months;
        $adviser->complaints_24_months = $request->complaints_24_months;
        $adviser->redress_cases_24_months = $request->redress_cases_24_months;
        $adviser->complaints_36_months = $request->complaints_36_months;
        $adviser->redress_cases_36_months = $request->redress_cases_36_months;
        $adviser->percentage_db_transfers = $request->percentage_db_transfers;
        $adviser->pension_specialist = $request->pension_specialist;
        $adviser->act_as_specialist = $request->act_as_specialist;
        $adviser->details_of_firms = $request->details_of_firms;
        $adviser->contact_name = $request->contact_name;
        $adviser->email_address = $request->email_address;
        $adviser->phone_number = $request->phone_number;
        $adviser->dial_code = $request->dial_code;
        $adviser->minimum_cetv = $request->minimum_cetv;
        $adviser->conduct_db_transfers = $request->conduct_db_transfers;
        $adviser->accept_insistent_clients = $request->accept_insistent_clients;
        $adviser->work_with_unregulated_firms = $request->work_with_unregulated_firms;
        $adviser->receive_referrals = $request->receive_referrals;
        $adviser->referral_details = $request->referral_details;
        $adviser->db_transfer_percentage = $request->db_transfer_percentage;
        $adviser->db_client_source = $request->db_client_source;
        $adviser->relationships_with_trustees = $request->relationships_with_trustees;
        $adviser->trustee_relationship_details = $request->trustee_relationship_details;
        $adviser->contingent_charging = $request->contingent_charging;
        $adviser->contingent_charging_details = $request->contingent_charging_details;
        $adviser->triage_service = $request->triage_service;
        $adviser->advice_fee = $request->advice_fee;
        $adviser->charging_structure_breakdown = $request->charging_structure_breakdown;



        $adviser->policies_coverage = $request->policies_coverage;
        $adviser->not_covered_details = $request->not_covered_details;
        $adviser->high_risk = $request->high_risk;
        $adviser->standard_risk = $request->standard_risk;
        $adviser->low_risk = $request->low_risk;
        $adviser->sensitive_jurisdictions = $request->sensitive_jurisdictions;
        $adviser->accept_peps = $request->accept_PEPs;
        $adviser->enhanced_due_diligence = $request->enhanced_due_diligence;
        $adviser->add_details_text = $request->add_details_text;
        $adviser->collect_source = $request->collect_source;
        $adviser->review_frequency = $request->review_frequency;



        $adviser->unregulated_firms = $request->unregulated_firms;
        $adviser->firms_details = $request->firms_details;
        $adviser->total_business_percentage = $request->total_business_percentage;
        $adviser->investments_introduced = $request->investments_introduced;
        $adviser->meet_client = $request->meet_client;
        $adviser->business_conducted = $request->business_conducted;
        $adviser->knowledgeable_investors = $request->knowledgeable_investors;
        $adviser->criteria_details = $request->criteria_details;
        $adviser->products_design = $request->products_design;
        $adviser->fair_value = $request->fair_value;
        $adviser->clear_communications = $request->clear_communications;
        $adviser->post_sales_support = $request->post_sales_support;
        $adviser->customer_understanding = $request->customer_understanding;
        
        $adviser->customer_adequate_controls = $request->customer_adequate_controls;
        $adviser->customer_evidence = $request->customer_evidence;
        $adviser->customer_had_licences = $request->customer_had_licences;



//         $url = '';
   
//   if ($request->hasFile('signature_adviser')) {

// $file = $request->signature_adviser;
//         $fileName = time() . '_' . $file->getClientOriginalName();
//         $path = $file->storeAs('documents', $fileName, 'public');
//         $url = asset('/storage/app/public/' . $path);
// }






    if ($request->has('signature_adviser')) {
        $signatureData = $request->signature_adviser;

        // Remove Base64 prefix
        if (strpos($signatureData, 'data:image/png;base64,') === 0) {
            $signatureData = substr($signatureData, strlen('data:image/png;base64,'));
        }

        // Replace spaces and decode Base64
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);

        // Validate decoding
        if ($signatureImage === false) {
        
            return back()->with('error', 'Invalid signature image format.');
        }

        // Generate unique filename
        $fileName = 'signature_' . time() . '.png';

        // Store the file in public disk under 'signatures' directory
        Storage::disk('public')->put('signatures/' . $fileName, $signatureImage);

        // Correct asset path for retrieving the image
         $signaturePath = asset('/storage/app/public/signatures/' . $fileName);
         
        $adviser->signature_adviser =  $signaturePath;

}

       
        $adviser->management_function = $request->management_function;
        $adviser->position_adviser = $request->position_adviser;
        $adviser->financial_adviser_number = $request->financial_adviser_number;
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;


        // $url = '';
        // if ($request->hasFile('signature_alltrust')) {

        // $file = $request->signature_alltrust;
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $path = $file->storeAs('documents', $fileName, 'public');
        //     $url = asset('/storage/app/public/' . $path);
        // }
        // $adviser->signature_alltrust =  $url;




    if ($request->has('signature_alltrust')) {
        $signatureData2 = $request->input('signature_alltrust');

        // Remove Base64 prefix
        if (strpos($signatureData2, 'data:image/png;base64,') === 0) {
            $signatureData2 = substr($signatureData2, strlen('data:image/png;base64,'));
        }

        // Replace spaces and decode Base64
        $signatureData2 = str_replace(' ', '+', $signatureData2);
        $signatureImage2 = base64_decode($signatureData2);

        // Validate decoding
        if ($signatureImage2 === false) {
            return back()->with('error', 'Invalid signature image format.');
        }

        // Generate unique filename
        $fileName2 = 'signature_' . time() . '.png';

        // Store the file in public disk under 'signatures' directory
        Storage::disk('public')->put('signatures/' . $fileName2, $signatureImage2);

        // Correct asset path for retrieving the image
         $signaturePath2 = asset('/storage/app/public/signatures/' . $fileName2);
        $adviser->signature_alltrust =  $signaturePath2;

}


//  =============  CDD Uploads start

if ($request->hasFile('company_structure_chart')) {
    $file = $request->file('company_structure_chart');
    $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    $path = $file->storeAs('documents', $fileName, 'public');
    $company_chart_url = asset('storage/app/public/' . $path);
    $adviser->company_structure_chart = $company_chart_url;
}

if ($request->hasFile('company_register_shareholder')) {
    $file = $request->file('company_register_shareholder');
     $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    $path = $file->storeAs('documents', $fileName, 'public');
    $company_shareholder_url = asset('storage/app/public/' . $path);
    $adviser->company_register_shareholder = $company_shareholder_url;
}

if ($request->hasFile('company_authorised_signatory')) {
    $file = $request->file('company_authorised_signatory');
     $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    $path = $file->storeAs('documents', $fileName, 'public');
    $company_authorised_url = asset('storage/app/public/' . $path);
    $adviser->company_authorised_signatory = $company_authorised_url;
}


    
     $jsonUrls = Null;
    
  if ($request->hasFile('adviser_multifiles')) {
    $urls = [];  
    foreach ($request->file('adviser_multifiles') as $file) {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $fileName, 'public');
        $url = url('/storage/app/public/' . $path);
        $urls[] = $url;
    }
    $jsonUrls = json_encode($urls);
}
    
   

// if (!empty($filePaths)) {
        $adviser->adviser_multifiles = $jsonUrls; 

    
$adviser->appointed_text = $request->appointed_text;


//  =============  CDD Uploads end


        $adviser->date_column = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
        $adviser->position_alltrust = $request->position_alltrust;
        $day2 = $request->day2;
        $month2 = $request->month2;
        $year2 = $request->year2;
        $adviser->date_column2 = Carbon::createFromDate($year2, $month2, $day2)->format('Y-m-d');
        $adviser->advisers = json_encode($request->adviser);
        $adviser->status = 'pending';
   
       $adviser->save();


if(auth()->user()->role == 'pre_approved_advisor'){
    
    $pre_user = User::find(auth()->user()->id);
    
    if ($pre_user->email_notification === 'yes') {
       $username = $pre_user->name;
        $userEmail = $pre_user->email;
       
        $messageContent = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Confirmation of Your Alltrust Terms of Business Application</h2>
                <p>Dear {$username},</p>
                <p>Thank you for completing our Terms of Business application.</p>
                <p>Our team is currently reviewing your application to ensure everything is in order. Should we require any additional information or clarification, someone from our team will contact you shortly.</p>
                <p>In the meantime, if you have any questions or need assistance, please contact us at <a href='#' style='color: #007bff; text-decoration: none;'>newbusiness@alltrust.co.uk</a>.</p>
                <p>We value your partnership and look forward to working with you.</p>
                <p>Warm regards,<br>The Alltrust Team</p>
            </div>
        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
    }
}

       
        $admin = User::where('role','admin')->first();
        
         if ($admin->email_notification === 'yes') {
             
        $username = $admin->name;
        $userEmail = $admin->email;
       
        $messageContent = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Adviser Terms Submission Alert</h2>
                <p>Dear {$username},</p>
                <p>We have received a new Terms application via the online portal. Please review the details at your earliest convenience.</p>
                <p>To access the application, click the link below:</p>
                <p><a href='#' target='_blank' style='color: #007bff; text-decoration: none;'>View Application</a></p>
                <p>Please liaise with the advisory firm or adviser directly with any questions or clarity required to complete the review process.</p>
                <p>Best regards,<br>The Alltrust Team</p>
            </div>

        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
        
        
}



if ($adviser->status === 'pending') {
    return redirect()->back()->with('success', 'Adviser updated successfully.');
} else {
    return redirect()->route('newAdviser-existing')->with('success', 'Adviser updated successfully.');
}
        return redirect(route('newAdviser-pending'))->with('success','Adviser Added Successsfully...');
    }


public function edit($id)
{
    // Retrieve all users with the role of 'adviser'
    $advisers = User::where('role', 'adviser')->get();
    // Retrieve the specific adviser by ID with related user data
    $editAdviser = Advisers::with('user')->find($id);
    $ad_role_mem = 'adviser';
    
    // Check if the adviser exists
    if (!$editAdviser) {
        return redirect()->route('dashboard.adviser.index')
                         ->with('error', 'Adviser not found.');
    }

    return view('dashboard.adviser.newAdviser.updateAdviser', compact('editAdviser','ad_role_mem', 'advisers'));
}
          
   

    public function update(Request $request,$id)
    {
           $ad_role_mem = User::find($request->user_id);
        $ad_role_mem->name = $request->user_name;
        $ad_role_mem->email = $request->user_email;
        $ad_role_mem->role = $request->role_member;
        $ad_role_mem->save();
        
        $adviser = Advisers::find($id);
        $adviser->company_name = $request->company_name;
        $adviser->trading_name = $request->trading_name;
        $adviser->address = $request->address;
        $adviser->country = $request->country;
        $adviser->post_code = $request->post_code;
        $adviser->share_holder_details = $request->share_holder_details;
        $adviser->regulated_adviser = $request->regulated_adviser;
        $adviser->contact_email = $request->contact_email;
        $adviser->website = $request->website;
        $adviser->telephone = $request->telephone;
        $adviser->fca_firms_reference = $request->fca_firms_reference;
        $adviser->directly_authorised_checked = $request->directly_authorised_checked;
        $adviser->principal_company_name = $request->principal_company_name;
        $adviser->their_frn = $request->their_frn;
        $adviser->advice = $request->advice;
        $adviser->provide_countries = $request->provide_countries;
        $adviser->hear_about_us = $request->hear_about_us;
        $adviser->word_of_referrals_checked = $request->word_of_referrals_checked;
        $adviser->lead_generation_checked = $request->lead_generation_checked;
        $adviser->marketing_checked = $request->marketing_checked;
        $adviser->other_specify_checked = $request->other_specify_checked;
        $adviser->restrictions_yes_permission = $request->restrictions_yes_permission;
        $adviser->restrictions_yes_permission_answer = $request->restrictions_yes_permission_answer;
        $adviser->sanctions = $request->sanctions;
        $adviser->sanctions_yes_answer = $request->sanctions_yes_answer;
        $adviser->connection_connection = $request->connection_connection;
        $adviser->connection_connection_yes_answer = $request->connection_connection_yes_answer;
        $adviser->professional_indemnity_insurance = $request->professional_indemnity_insurance;
        $adviser->policy_excess_DB = $request->policy_excess_DB;
        $adviser->other_money = $request->other_money;

        $adviser->separate_cyber_security = $request->separate_cyber_security;
        $adviser->permissions_for_advising = $request->permissions_for_advising;
        $adviser->initial_advice_fee = $request->initial_advice_fee;
        $adviser->going_annual_fee = $request->going_annual_fee;
        $adviser->house_portfolio_solutions = $request->house_portfolio_solutions;
        $adviser->receive_provider_commission = $request->receive_provider_commission;
        $adviser->investment_strategy = json_encode($request->investmentStrategy);
        $adviser->typical_investment_strategy = $request->typical_investment_strategy;
        $adviser->running_managing_portfolios = $request->running_managing_portfolios;
        $adviser->basis = $request->basis;
        $adviser->principal_company_name1 = $request->principal_company_name1;
        $adviser->principal_company_name2 = $request->principal_company_name2;
        $adviser->principal_company_name3 = $request->principal_company_name3;
        $adviser->principal_company_name4 = $request->principal_company_name4;
        $adviser->account_name = $request->account_name;
        $adviser->bank_name = $request->bank_name;
        $adviser->account_number = $request->account_number;
        $adviser->sort_code = $request->sort_code;
        $adviser->not_applicable = $request->not_applicable;
        $adviser->advisers_permitted = $request->advisers_permitted;
        $adviser->staff_supervisory_position = $request->staff_supervisory_position;
        $adviser->gold_standard = $request->gold_standard;
        $adviser->db_transfers_12_months = $request->db_transfers_12_months;
        $adviser->total_value_12_months = $request->total_value_12_months;
        $adviser->percentage_db_transfers_12_months = $request->percentage_db_transfers_12_months;
        $adviser->db_transfers_24_months = $request->db_transfers_24_months;
        $adviser->total_value_24_months = $request->total_value_24_months;
        $adviser->percentage_db_transfers_24_months = $request->percentage_db_transfers_24_months;
        $adviser->db_transfers_36_months = $request->db_transfers_36_months;
        $adviser->total_value_36_months = $request->total_value_36_months;
        $adviser->percentage_db_transfers_36_months = $request->percentage_db_transfers_36_months;
        $adviser->complaints_12_months = $request->complaints_12_months;
        $adviser->redress_cases_12_months = $request->redress_cases_12_months;
        $adviser->complaints_24_months = $request->complaints_24_months;
        $adviser->redress_cases_24_months = $request->redress_cases_24_months;
        $adviser->complaints_36_months = $request->complaints_36_months;
        $adviser->redress_cases_36_months = $request->redress_cases_36_months;
        $adviser->percentage_db_transfers = $request->percentage_db_transfers;
        $adviser->pension_specialist = $request->pension_specialist;
        $adviser->act_as_specialist = $request->act_as_specialist;
        $adviser->details_of_firms = $request->details_of_firms;
        $adviser->contact_name = $request->contact_name;
        $adviser->email_address = $request->email_address;
        $adviser->phone_number = $request->phone_number;
        $adviser->dial_code = $request->dial_code;
        $adviser->minimum_cetv = $request->minimum_cetv;
        $adviser->conduct_db_transfers = $request->conduct_db_transfers;
        $adviser->accept_insistent_clients = $request->accept_insistent_clients;
        $adviser->work_with_unregulated_firms = $request->work_with_unregulated_firms;
        $adviser->receive_referrals = $request->receive_referrals;
        $adviser->referral_details = $request->referral_details;
        $adviser->db_transfer_percentage = $request->db_transfer_percentage;
        $adviser->db_client_source = $request->db_client_source;
        $adviser->relationships_with_trustees = $request->relationships_with_trustees;
        $adviser->trustee_relationship_details = $request->trustee_relationship_details;
        $adviser->contingent_charging = $request->contingent_charging;
        $adviser->contingent_charging_details = $request->contingent_charging_details;
        $adviser->triage_service = $request->triage_service;
        $adviser->advice_fee = $request->advice_fee;
        $adviser->charging_structure_breakdown = $request->charging_structure_breakdown;

        $adviser->policies_coverage = $request->policies_coverage;
        $adviser->not_covered_details = $request->not_covered_details;
        $adviser->high_risk = $request->high_risk;
        $adviser->standard_risk = $request->standard_risk;
        $adviser->low_risk = $request->low_risk;
        $adviser->sensitive_jurisdictions = $request->sensitive_jurisdictions;
        $adviser->accept_peps = $request->accept_PEPs;
        $adviser->enhanced_due_diligence = $request->enhanced_due_diligence;
        $adviser->add_details_text = $request->add_details_text;
        $adviser->collect_source = $request->collect_source;
        $adviser->review_frequency = $request->review_frequency;



        $adviser->unregulated_firms = $request->unregulated_firms;
        $adviser->firms_details = $request->firms_details;
        $adviser->total_business_percentage = $request->total_business_percentage;
        $adviser->meet_client = $request->meet_client;
        $adviser->business_conducted = $request->business_conducted;
        $adviser->knowledgeable_investors = $request->knowledgeable_investors;
        $adviser->criteria_details = $request->criteria_details;

        $adviser->products_design = $request->products_design;
        $adviser->fair_value = $request->fair_value;
        $adviser->clear_communications = $request->clear_communications;
        $adviser->post_sales_support = $request->post_sales_support;
        $adviser->customer_understanding = $request->customer_understanding;


        $url = $request->old1;
    // Handle file upload
  if ($request->hasFile('signature_adviser')) {

$file = $request->signature_adviser;
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $fileName, 'public');
        $url = asset('/storage/app/public/' . $path);
}

$adviser->signature_adviser = $url;


//  =============  CDD Uploads start

if ($request->hasFile('company_structure_chart')) {
    $file = $request->file('company_structure_chart');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('documents', $fileName, 'public');
    $company_chart_url = asset('/storage/app/public/' . $path);
    // Save the URL to the model
    $adviser->company_structure_chart = $company_chart_url;
}

if ($request->hasFile('company_register_shareholder')) {
    $file = $request->file('company_register_shareholder');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('documents', $fileName, 'public');
    $company_shareholder_url = asset('/storage/app/public/' . $path);
    // Save the URL to the model
    $adviser->company_register_shareholder = $company_shareholder_url;
}

if ($request->hasFile('company_authorised_signatory')) {
    $file = $request->file('company_authorised_signatory');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('documents', $fileName, 'public');
    $company_authorised_url = asset('/storage/app/public/' . $path);
    // Save the URL to the model
    $adviser->company_authorised_signatory = $company_authorised_url;
}


    
    // Handle file upload
    
     $jsonUrls = $request->old;
    
  if ($request->hasFile('adviser_multifiles')) {
    $urls = [];  
    foreach ($request->file('adviser_multifiles') as $file) {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $fileName, 'public');
        $url = url('/storage/app/public/' . $path);
        $urls[] = $url;
    }
    $jsonUrls = json_encode($urls);
}
    
   

// if (!empty($filePaths)) {
        $adviser->adviser_multifiles = $jsonUrls; 





$adviser->appointed_text = $request->appointed_text;


//  =============  CDD Uploads end

        $adviser->position_adviser = $request->position_adviser;
        $adviser->financial_adviser_number = $request->financial_adviser_number;
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;


        $url = $request->old2;
        // Handle file upload
      if ($request->hasFile('signature_alltrust')) {

    $file = $request->signature_alltrust;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $fileName, 'public');
            $url = asset('/storage/app/public/' . $path);
    }

    $adviser->signature_alltrust = $url;
        $adviser->date_column = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
        $adviser->position_alltrust = $request->position_alltrust;
        $day2 = $request->day2;
        $month2 = $request->month2;
        $year2 = $request->year2;
        $adviser->date_column2 = Carbon::createFromDate($year2, $month2, $day2)->format('Y-m-d');
        $adviser->advisers = json_encode($request->adviser);
        
        $adviser->update();

    
        

    if ($request->status === 'pending') {
    return redirect()->route('newAdviser-pending')->with('success', 'Adviser updated successfully.');
} else {
    return redirect()->route('newAdviser-existing')->with('success', 'Adviser updated successfully.');
}
    }



    public function existing()
    {
        if(auth()->user()->role == 'admin'){
                        $existingAdviser = Advisers::where('status', 'active')->get();
        }else{
                 $existingAdviser = Advisers::where('status', 'active')->where('creater_id',auth()->user()->id)->get();
        }
        
        return view('dashboard.adviser.newAdviser.existingAdviser', compact('existingAdviser'));
    }

    public function pending()
    {
        if(auth()->user()->role == 'admin'){
                        $advisers = Advisers::where('status', 'pending')->get();
        }else{
                 $advisers = Advisers::where('status', 'pending')->where('creater_id',auth()->user()->id)->get();
        }
        
       
        return view('dashboard.adviser.newAdviser.pendingAdviser', compact('advisers'));
    }
    public function destroy($id)
    {
        $adviser = Advisers::find($id);
        if ($adviser) {
            $adviser->delete(); // Soft delete
            return redirect()->back()->with('success', 'Adviser deleted successfully.');
        }

        return redirect()->back()->with('error', 'Adviser not found.');
    }

    public function deleted()
{
    // Fetch all deleted advisers
    $onshores = Advisers::onlyTrashed()->get();
    $offshores = Offshore::onlyTrashed()->get();
    return view('dashboard.adviser.newAdviser.deletedAdvisers', compact('onshores','offshores'));
}

public function show($id)
{
    $advisers = User::where('role', 'onshore_adviser')->get();

    $editAdviser = Advisers::find($id);
    return view('dashboard.adviser.newAdviser.viewAdviser',compact('editAdviser','advisers'));
}
public function pendingadviser($id,$status){
    $offadviser = Advisers::find($id);

    $offadviser->status = $status;

    $offadviser->save();
    return redirect()->back();
}

public function restore($id)
{
    $adviser = Advisers::onlyTrashed()->find($id); // Find the adviser in the trashed state
    
    if ($adviser) {
        $adviser->restore(); // Restore the adviser
        return redirect()->back()->with('success', 'Adviser restored successfully.');
    }

    return redirect()->back()->with('error', 'Adviser not found.');
}





public function declinedList()
{
    if(auth()->user()->role == 'admin'){
                 $declinedAdvisers = Advisers::where('status', 'decline')->get();
        }else{
                 $declinedAdvisers = Advisers::where('status', 'decline')->where('creater_id',auth()->user()->id)->get();
        }
    
    $declinedAdvisers = Advisers::where('status', 'decline')->get();
    return view('dashboard.adviser.newAdviser.declinedAdviser', compact('declinedAdvisers'));
}


}
