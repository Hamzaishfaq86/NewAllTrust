<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes

class Advisers extends Model
{
    use HasFactory, SoftDeletes; // Include SoftDeletes trait

    protected $table = 'advisers'; // Specify the table name

    // Fillable fields
    protected $fillable = [
        'selected_adviser_id',
        'company_name',
        'trading_name',
        'address',
        'country',
        'post_code',
        'principal_comapny_name',
        'share_holder_details',
        'regulated_adviser',
        'contact_email',
        'website',
        'telephone',
        'fca_firms_reference',
        'directly_authorised_checked',
        'principal_company_name',
        'their_frn',
        'advice',
        'provide_countries',
        'hear_about_us',
        'word_of_referrals_checked',
        'lead_generation_checked',
        'lead_generation_company',
        'marketing_checked',
        'other_specify_checked',
        'other_specify',
        'restrictions_yes_permission',
        'restrictions_yes_permission_answer',
        'sanctions',
        'sanctions_yes_answer',
        'connection_connection',
        'connection_connection_yes_answer',
        'professional_indemnity_insurance',
        'policy_excess_DB',
        'separate_cyber_security',
        'permissions_for_advising',
        'initial_advice_fee',
        'going_annual_fee',
        'house_portfolio_solutions',
        'receive_provider_commission',
        'investment_strategy',
        'running_managing_portfolios',
        'basis',
        'principal_company_name1',
        'principal_company_name2',
        'principal_company_name3',
        'principal_company_name4',
        'account_name',
        'bank_name',
        'account_number',
        'sort_code',
        'not_applicable',
        'advisers_permitted',
        'staff_supervisory_position',
        'gold_standard',
        'db_transfers_12_months',
        'total_value_12_months',
        'percentage_db_transfers_12_months',
        'db_transfers_24_months',
        'total_value_24_months',
        'percentage_db_transfers_24_months',
        'db_transfers_36_months',
        'total_value_36_months',
        'percentage_db_transfers_36_months',
        'complaints_12_months',
        'redress_cases_12_months',
        'complaints_24_months',
        'redress_cases_24_months',
        'complaints_36_months',
        'redress_cases_36_months',
        'percentage_db_transfers',
        'pension_specialist',
        'act_as_specialist',
        'details_of_firms',
        'contact_name',
        'email_address',
        'phone_number',
        'dial_code',
        'minimum_cetv',
        'conduct_db_transfers',
        'accept_insistent_clients',
        'work_with_unregulated_firms',
        'receive_referrals',
        'referral_details',
        'db_transfer_percentage',
        'db_client_source',
        'relationships_with_trustees',
        'trustee_relationship_details',
        'contingent_charging',
        'contingent_charging_details',
        'triage_service',
        'advice_fee',
        'charging_structure_breakdown',
        'signature_adviser',
        'management_function',
        'position_adviser',
        'financial_adviser_number',
        'date_column',
        'signature_alltrust',
        
        'company_structure_chart',
        'company_register_shareholder',
        'company_authorised_signatory',
        'appointed_text',
        
        'position_alltrust',
        'date_column2',
        'adviser_name',
        'adviser_fca_reference',
        'approved_for_transfer_db',
        'branch',
        'requires_online_access',
    ];

    // Specify the dates for soft deletes
    protected $dates = ['deleted_at'];
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'selected_adviser_id');
    }
}
