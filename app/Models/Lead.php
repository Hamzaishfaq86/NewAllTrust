<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads';

    protected $fillable = [
        'company_name',
        'trading_name',
        'address',
        'country',
        'post_code',
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
        'marketing_checked',
        'other_specify_checked',
        'restrictions_yes_permission',
        'restrictions_yes_permission_answer',
        'sanctions',
        'sanctions_yes_answer',
        'connection_connection',
        'connection_connection_yes_answer',
        'professional_indemnity_insurance',
        'policy_excess_DB',
        'separate_cyber_security',
        'permissions_for_advising'
    ];
}
