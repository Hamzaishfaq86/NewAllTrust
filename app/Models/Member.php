<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line

class Member extends Model
{
    use HasFactory, SoftDeletes; // Include SoftDeletes trait

    protected $casts = [
        'first_name' => 'array',
        'middle_name' => 'array',
        'member_surname' => 'array',
        'date_of_birth' => 'array',
        'date_moved_in' => 'array',
        'country_of_birth' => 'array',
        'home_telephone_number' => 'array',
        'mobile_number' => 'array',
        'member_email_address' => 'array',
        'member_nationality' => 'array',
        'privacy_print_name' => 'array',
        'privacy_signature' => 'array',
        'privacy_position' => 'array',
        'privacy_date' => 'array',
        
        'trustee_name' => 'array',
        'trustee_signature' => 'array',
        'trustee_date' => 'array',
        
        'tax_residence_country' => 'array',
        'tin_number' => 'array',
        'tin_reason' => 'array',
    ];
    
    protected $table = 'members';
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
