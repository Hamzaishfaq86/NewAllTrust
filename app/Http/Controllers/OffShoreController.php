<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SimpleMail;
use App\Models\Offshore;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class OffShoreController extends Controller
{
    public function create()
    {
        $advisers = User::where('role', 'offshore_adviser')->get();
        $ad_role_mem = 'offshore_adviser';

        return view('dashboard.adviser.offshoreadviser.offshoreadviser', compact('advisers','ad_role_mem'));
    }


    public function country_store(Request $request)
    {
        
        $id = $request->id;
        $userData = OffShore::find($id);
        $userData->admin_country = json_encode($request->admin_country);
        $userData->save();
        return redirect()->back();
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

    
    $ad_role_mem->offshore_check = 'offshore_check';

    
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
        $userData = new Offshore();
        $userData->selected_adviser_id = $ad_role_mem->id;
        $userData->company_name = $request->company_name;
         $userData->creater_id = auth()->user()->id; 
        $userData->trading_as = $request->trading_as;
        $userData->type = $request->type;
        $userData->other_details = $request->other_details;
        $userData->main_contact = $request->main_contact;
        $userData->additional_details = $request->additional_details;
        $userData->surname_surname = $request->surname_surname;
        $userData->forename = $request->forename;
        $userData->previous_names = $request->previous_names;
        $userData->registered_address = $request->registered_address;
        $userData->registered_country = $request->registered_country;
        $userData->registered_post_code = $request->registered_post_code;
        $userData->physical_address = $request->physical_address;
        $userData->physical_country = $request->physical_country;
        $userData->physical_post_code = $request->physical_post_code;
        $userData->office_number = $request->office_number;
        $userData->direct_line = $request->direct_line;
        $userData->mobile_number = $request->mobile_number;
        $userData->email_address = $request->email_address;
        $userData->website = $request->website;
        $userData->financial_adviser = $request->financial_adviser;
        $userData->insurance_broker = $request->insurance_broker;
        $userData->asset_manager = $request->asset_manager;
        $userData->accountant = $request->accountant;
        $userData->tax_adviser = $request->tax_adviser;
        $userData->lawyer = $request->lawyer;
        $userData->other_business_activity = $request->other_business_activity;
        $userData->other_business_specify = $request->other_business_specify;
        $userData->licensing_body = $request->licensing_body;
        $userData->licensing_reference = $request->licensing_reference;
        $userData->restrictions = $request->restrictions;
        $userData->restrictions_imposed = $request->restrictions_imposed;
        $userData->insurance = $request->insurance;
        $userData->investment = $request->investment;
        $userData->regulatory_visit = $request->regulatory_visit;
        $userData->date_follow = $request->date_follow;
        $userData->areas_review = $request->areas_review;
        $userData->highlighted_review = $request->highlighted_review;
        $userData->percentage_breakdown = $request->percentage_breakdown;
        $userData->professional_indemnity = $request->professional_indemnity;
        $userData->cyber_insurance = $request->cyber_insurance;
        $userData->face_to_face = $request->face_to_face;
        $userData->non_face_policy = $request->non_face_policy;
        $userData->high_risk = $request->high_risk;
        $userData->standard_risk = $request->standard_risk;
        $userData->low_risk = $request->low_risk;
        $userData->sanctioned = $request->sanctioned;
        $userData->refer = $request->refer;
        $userData->client_risk = $request->client_risk;
        $userData->kyc_revisit = $request->kyc_revisit;
        $userData->accept_peps = $request->accept_peps;
        $userData->pep_policy = $request->pep_policy;
        $userData->due_diligence = $request->due_diligence;
        $userData->provide_details = $request->provide_details;
        
        $userData->collectDetails = $request->collectDetails;
        $userData->writtenPolicies = $request->writtenPolicies;
        $userData->reviewDocuments = $request->reviewDocuments;
        $userData->updatedDocuments = $request->updatedDocuments;
        $userData->amlPolicies = $request->amlPolicies;
        $userData->trainingFrequency = $request->trainingFrequency;
        $userData->internalCompliance = $request->internalCompliance;
        $userData->complianceApproval = $request->complianceApproval;
        $userData->complianceComments = $request->complianceComments;
        $userData->countryLists_highRisk = $request->countryLists_highRisk;
        $userData->countryLists_fatf = $request->countryLists_fatf;
        $userData->countryLists_sanctioned = $request->countryLists_sanctioned;
        $userData->countryLists_corruption = $request->countryLists_corruption;
        $userData->countryLists_complianceAlert = $request->countryLists_complianceAlert;
        $userData->countryLists_drugTrafficking = $request->countryLists_drugTrafficking;
        $userData->additionalComments = $request->additionalComments;
        $userData->screenSystems = $request->screenSystems;
        $userData->identifyHighRisk = $request->identifyHighRisk;
        $userData->recordDetails_intended = $request->recordDetails_intended;
        $userData->recordDetails_expected = $request->recordDetails_expected;
        $userData->recordDetails_perTransaction = $request->recordDetails_perTransaction;
        $userData->yes_details = $request->yes_details;

        $userData->risk_assessment = $request->risk_assessment;
        $userData->risk_details = $request->risk_details;
        $userData->client_fee_structure = $request->client_fee_structure;
        $userData->investment_products = $request->investment_products;
        $userData->products_details = $request->products_details;
        $userData->platform_WRAP = $request->platform_WRAP;
        $userData->funds_platform = $request->funds_platform;
        $userData->market_investments = $request->market_investments;
        $userData->restricted_mass = $request->restricted_mass;
        $userData->advisory_stockbroker = $request->advisory_stockbroker;
        $userData->model_portfolios = $request->model_portfolios;
        $userData->investments_defined = $request->investments_defined;
        $userData->structured_deposits = $request->structured_deposits;
        $userData->deposit_accounts = $request->deposit_accounts;
        $userData->commercial_property = $request->commercial_property;
        $userData->title = $request->title;
        $userData->please_details = $request->please_details;
        $userData->surname = $request->surname;
        $userData->forenames = $request->forenames;
        $userData->profession = $request->profession;
        $userData->qualifications = $request->qualifications;
        $userData->certifiers_address = $request->certifiers_address;
        $userData->country = $request->country;
        $userData->post_code = $request->post_code;
        $userData->full_name_1 = $request->full_name_1;
        $userData->position_1 = $request->position_1;
        $userData->signature_1 = $request->signature_1;
        if ($request->hasFile('signature_1')) {
             
          
            $file = $request->signature_1;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $fileName, 'public');
            $url = url('/storage/app/public/' . $path);
            $userData->signature_1 = $url;
           }

        $userData->date_signed_1 = $request->date_signed_1;
        $userData->full_name_2 = $request->position_2;
        $userData->signature_2 = $request->signature_2;
        if ($request->hasFile('signature_2')) {
             
          
            $file = $request->signature_1;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $fileName, 'public');
            $url = url('/storage/app/public/' . $path);
            $userData->signature_2 = $url;
           }

        $userData->date_signed_2 = $request->date_signed_2;
        $userData->date_received = $request->date_received;
        $userData->date_approved = $request->date_approved;
        $userData->approved_by = $request->approved_by;
        $userData->approval_signature = $request->approval_signature;
        if ($request->hasFile('approval_signature')) {
             
            $file = $request->approval_signature;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $fileName, 'public');
            $url = url('/storage/app/public/' . $path);
            $userData->approval_signature = $url;
           }
        $userData->status = 'pending';
        
        
        
        
        
        //  =============  CDD Uploads start
            
            if ($request->hasFile('company_structure_chart')) {
                $file = $request->file('company_structure_chart');
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = $file->storeAs('documents', $fileName, 'public');
                $company_chart_url = asset('storage/app/public/' . $path);
                $userData->company_structure_chart = $company_chart_url;
            }
            
            if ($request->hasFile('company_register_shareholder')) {
                $file = $request->file('company_register_shareholder');
                 $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = $file->storeAs('documents', $fileName, 'public');
                $company_shareholder_url = asset('storage/app/public/' . $path);
                $userData->company_register_shareholder = $company_shareholder_url;
            }
            
            if ($request->hasFile('company_authorised_signatory')) {
                $file = $request->file('company_authorised_signatory');
                 $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = $file->storeAs('documents', $fileName, 'public');
                $company_authorised_url = asset('storage/app/public/' . $path);
                $userData->company_authorised_signatory = $company_authorised_url;
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
                    $userData->adviser_multifiles = $jsonUrls; 
            
                
            $userData->appointed_text = $request->appointed_text;
            
            
            //  =============  CDD Uploads end
        

       $userData->save();

if(auth()->user()->role == 'pre_approved_advisor'){

$preapprove = User::find(auth()->user()->id);

            
            if ($preapprove->email_notification === 'yes') {
                $username = $preapprove->name;
                $userEmail = $preapprove->email;
            
                $messageContent = "
                    <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                        <h2 style='color: #333;'>Confirmation of Your Alltrust Terms of Business Application</h2>
                        <p>Dear {$username},</p>
                        <p>Thank you for completing our Terms of Business application.</p>
                        <p>Our team is currently reviewing your application to ensure everything is in order. Should we require any additional information or clarification, someone from our team will contact you shortly.</p>
                        <p>In the meantime, if you have any questions or need assistance, please contact us at <a href='' style='color: #007bff; text-decoration: none;'>newbusiness@alltrust.co.uk</a>.</p>
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
                <p><a href='https://newalltrust.ilcorpdev.com/newAdviser-show' target='_blank' style='color: #007bff; text-decoration: none;'>View Application</a></p>
                <p>Please liaise with the advisory firm or adviser directly with any questions or clarity required to complete the review process.</p>
                <p>Best regards,<br>The Alltrust Team</p>
            </div>

        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
        }

if ($userData->status === 'pending') {
    return redirect()->back()->with('success', 'Thank you for submitting your application. A member of our team will be in contact with you shortly.');
} else {
    return redirect()->route('newoffshore-existing')->with('success', 'Offshore Added successfully.');
}
        return redirect(route('newoffshore-pending'))->with('success','Offshore Added Successsfully...');
        
    }




    public function edit($id)
{
    // Retrieve all users with the role of 'adviser'
    $advisers = User::where('role', 'adviser')->get();
    // Retrieve the specific adviser by ID with related user data
    $display = Offshore::with('user')->find($id);
    $ad_role_mem = 'adviser';

    // Check if the adviser exists
    if (!$display) {
        return redirect()->route('newOffshore')
                         ->with('error', 'Adviser not found.');
    }

    return view('dashboard.adviser.offshoreadviser.updateoffshore', compact('display','ad_role_mem', 'advisers'));
}

public function update(Request $request,$id)
{
       $ad_role_mem = User::find($request->user_id);
    $ad_role_mem->name = $request->user_name;
    $ad_role_mem->email = $request->user_email;
    $ad_role_mem->role = $request->role_member;
    $ad_role_mem->save();

    $adviser = Offshore::find($id);
    
     $adviser->company_name = $request->company_name;
            $adviser->trading_as = $request->trading_as;
            $adviser->type = $request->type;
            $adviser->other_details = $request->other_details;
            $adviser->main_contact = $request->main_contact;
            $adviser->additional_details = $request->additional_details;
            $adviser->surname_surname = $request->surname_surname;
            $adviser->forename = $request->forename;
            $adviser->previous_names = $request->previous_names;
            $adviser->registered_address = $request->registered_address;
            $adviser->registered_country = $request->registered_country;
            $adviser->registered_post_code = $request->registered_post_code;
            $adviser->physical_address = $request->physical_address;
            $adviser->physical_country = $request->physical_country;
            $adviser->physical_post_code = $request->physical_post_code;
            $adviser->office_number = $request->office_number;
            $adviser->direct_line = $request->direct_line;
            $adviser->mobile_number = $request->mobile_number;
            $adviser->email_address = $request->email_address;
            $adviser->website = $request->website;
            $adviser->financial_adviser = $request->financial_adviser;
            $adviser->insurance_broker = $request->insurance_broker;
            $adviser->asset_manager = $request->asset_manager;
            $adviser->accountant = $request->accountant;
            $adviser->tax_adviser = $request->tax_adviser;
            $adviser->lawyer = $request->lawyer;
            $adviser->other_business_activity = $request->other_business_activity;
            $adviser->other_business_specify = $request->other_business_specify;
            $adviser->licensing_body = $request->licensing_body;
            $adviser->licensing_reference = $request->licensing_reference;
            $adviser->restrictions = $request->restrictions;
            $adviser->restrictions_imposed = $request->restrictions_imposed;
            $adviser->insurance = $request->insurance;
            $adviser->investment = $request->investment;
            $adviser->regulatory_visit = $request->regulatory_visit;
            $adviser->date_follow = $request->date_follow;
            $adviser->areas_review = $request->areas_review;
            $adviser->highlighted_review = $request->highlighted_review;
            $adviser->percentage_breakdown = $request->percentage_breakdown;
            $adviser->professional_indemnity = $request->professional_indemnity;
            $adviser->cyber_insurance = $request->cyber_insurance;
            $adviser->face_to_face = $request->face_to_face;
            $adviser->non_face_policy = $request->non_face_policy;
            $adviser->high_risk = $request->high_risk;
            $adviser->standard_risk = $request->standard_risk;
            $adviser->low_risk = $request->low_risk;
            $adviser->sanctioned = $request->sanctioned;
            $adviser->refer = $request->refer;
            $adviser->client_risk = $request->client_risk;
            $adviser->kyc_revisit = $request->kyc_revisit;
            $adviser->accept_peps = $request->accept_peps;
            $adviser->pep_policy = $request->pep_policy;
            $adviser->due_diligence = $request->due_diligence;
            $adviser->provide_details = $request->provide_details;
            
            $adviser->collectDetails = $request->collectDetails;
            $adviser->writtenPolicies = $request->writtenPolicies;
            $adviser->reviewDocuments = $request->reviewDocuments;
            $adviser->updatedDocuments = $request->updatedDocuments;
            $adviser->amlPolicies = $request->amlPolicies;
            $adviser->trainingFrequency = $request->trainingFrequency;
            $adviser->internalCompliance = $request->internalCompliance;
            $adviser->complianceApproval = $request->complianceApproval;
            $adviser->complianceComments = $request->complianceComments;
            $adviser->countryLists_highRisk = $request->countryLists_highRisk;
            $adviser->countryLists_fatf = $request->countryLists_fatf;
            $adviser->countryLists_sanctioned = $request->countryLists_sanctioned;
            $adviser->countryLists_corruption = $request->countryLists_corruption;
            $adviser->countryLists_complianceAlert = $request->countryLists_complianceAlert;
            $adviser->countryLists_drugTrafficking = $request->countryLists_drugTrafficking;
            $adviser->additionalComments = $request->additionalComments;
            $adviser->screenSystems = $request->screenSystems;
            $adviser->identifyHighRisk = $request->identifyHighRisk;
            $adviser->recordDetails_intended = $request->recordDetails_intended;
            $adviser->recordDetails_expected = $request->recordDetails_expected;
            $adviser->recordDetails_perTransaction = $request->recordDetails_perTransaction;
            $adviser->yes_details = $request->yes_details;
            
            $adviser->risk_assessment = $request->risk_assessment;
            $adviser->risk_details = $request->risk_details;
            $adviser->client_fee_structure = $request->client_fee_structure;
            $adviser->investment_products = $request->investment_products;
            $adviser->products_details = $request->products_details;
            $adviser->platform_WRAP = $request->platform_WRAP;
            $adviser->funds_platform = $request->funds_platform;
            $adviser->market_investments = $request->market_investments;
            $adviser->restricted_mass = $request->restricted_mass;
            $adviser->advisory_stockbroker = $request->advisory_stockbroker;
            $adviser->model_portfolios = $request->model_portfolios;
            $adviser->investments_defined = $request->investments_defined;
            $adviser->structured_deposits = $request->structured_deposits;
            $adviser->deposit_accounts = $request->deposit_accounts;
            $adviser->commercial_property = $request->commercial_property;
            $adviser->title = $request->title;
            $adviser->please_details = $request->please_details;
            $adviser->surname = $request->surname;
            $adviser->forenames = $request->forenames;
            $adviser->profession = $request->profession;
            $adviser->qualifications = $request->qualifications;
            $adviser->certifiers_address = $request->certifiers_address;
            $adviser->country = $request->country;
            $adviser->post_code = $request->post_code;
            $adviser->full_name_1 = $request->full_name_1;
            $adviser->position_1 = $request->position_1;
            $adviser->signature_1 = $request->signature_1;
            // Handle file upload
            $url = $request->old;
            if ($request->hasFile('signature_1')) {
            
              $file = $request->signature_1;
              $fileName = time() . '_' . $file->getClientOriginalName();
              $path = $file->storeAs('documents', $fileName, 'public');
              $url = url('/storage/app/public/' . $path);
                 
            }
            $adviser->signature_1 = $url;

            $adviser->date_signed_1 = $request->date_signed_1;
            $adviser->full_name_2 = $request->full_name_2;
            $adviser->position_2 = $request->position_2;
            $adviser->signature_2 = $request->signature_2;
            // Handle file upload
            $url = $request->old;
            if ($request->hasFile('signature_2')) {
            
              $file = $request->signature_2;
              $fileName = time() . '_' . $file->getClientOriginalName();
              $path = $file->storeAs('documents', $fileName, 'public');
              $url = url('/storage/app/public/' . $path);
                 
            }
            $adviser->signature_2 = $url;

            $adviser->date_signed_2 = $request->date_signed_2;
            $adviser->date_received = $request->date_received;
            $adviser->date_approved = $request->date_approved;
            $adviser->approved_by = $request->approved_by;
            $adviser->approval_signature = $request->approval_signature;
            // Handle file upload
            $url = $request->old;
            if ($request->hasFile('approval_signature')) {
            
              $file = $request->approval_signature;
              $fileName = time() . '_' . $file->getClientOriginalName();
              $path = $file->storeAs('documents', $fileName, 'public');
              $url = url('/storage/app/public/' . $path);
                 
            }
            $adviser->approval_signature = $url;
            
            
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
            
            

    $adviser->update();




if ($request->status === 'pending') {
return redirect()->route('offshore.pendingList')->with('success', 'Offshore Updated successfully.');
} else {
return redirect()->route('offshore.existingList')->with('success', 'Offshore updated successfully.');
}
}

public function existingList()
{
 
    if(auth()->user()->role == 'admin'){
                      $existingAdviser = Offshore::where('status', 'active')->get();
        }else{
                 $existingAdviser = Offshore::where('status', 'active')->where('creater_id',auth()->user()->id)->get();
        }
    
    return view('dashboard.adviser.offshoreadviser.existingoffshore', compact('existingAdviser'));
}

public function pendingList()
{
    if(auth()->user()->role == 'admin'){
                      $advisers = Offshore::where('status', 'pending')->get();
        }else{
                 $advisers = Offshore::where('status', 'pending')->where('creater_id',auth()->user()->id)->get();
        }
    
    
    return view('dashboard.adviser.offshoreadviser.pendingoffshore', compact('advisers'));
}
public function destroy($id)
{
    $adviser = Offshore::find($id);
    if ($adviser) {
        $adviser->delete(); // Soft delete
        return redirect()->back()->with('success', 'Adviser deleted successfully.');
    }

    return redirect()->back()->with('error', 'Adviser not found.');
}

public function deleted()
{
// Fetch all deleted advisers
$deletedAdvisers = Offshore::onlyTrashed()->get();
return view('dashboard.adviser.offshoreadviser.deletedoffshore', compact('deletedAdvisers'));
}


public function show($id)
{
    $advisers = User::where('role', 'offshore_adviser')->get();

    $display = Offshore::find($id);
    return view('dashboard.adviser.offshoreadviser.viewoffshore',compact('display','advisers'));
}
public function pendingoffadviser($id,$status){

    $offadviser = Offshore::find($id);

    $offadviser->status = $status;

    $offadviser->save();
    return redirect()->back();
}


public function existingStatus($id){
    $adviser = Offshore::find($id);
    if($adviser->status == 'active'){
    $adviser->status = 'pending';
    }else{
        $adviser->status = 'active';
    }
    $adviser->save();
    return redirect()->back();
}
public function restore($id)
{
    $adviser = Offshore::onlyTrashed()->find($id); // Find the adviser in the trashed state

    if ($adviser) {
        $adviser->restore(); // Restore the adviser
        return redirect()->back()->with('success', 'Offset restored successfully.');
    }

    return redirect()->back()->with('error', 'Adviser not found.');
}


public function declinedList()
{
    if(auth()->user()->role == 'admin'){
                 $declinedAdvisers = Offshore::where('status', 'decline')->get();
        }else{
                 $declinedAdvisers = Offshore::where('status', 'decline')->where('creater_id',auth()->user()->id)->get();
        }
    
   
    return view('dashboard.adviser.offshoreadviser.declinedoffshore', compact('declinedAdvisers'));
}




}
