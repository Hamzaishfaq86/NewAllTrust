<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PragmaRX\Google2FASupport\Google2FA;

class User extends Authenticatable implements MustVerifyEmail
{
    
    use HasApiTokens, HasFactory, Notifiable;
 
 protected $guarded = [];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];
     protected $casts = [
        'two_step_expires_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    public function user()
{
    return $this->belongsTo(User::class);
}

public function adviser()
    {
        return $this->hasOne(Advisers::class, 'user_id'); // Ensure 'user_id' is the foreign key in Advisers
    }

    public function generateTwoFactorSecret()
    {
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();
        $this->google2fa_secret = $secret;
        $this->save();
        return $secret;
    }

    public function enableTwoFactorAuth($secret)
    {
        $this->google2fa_enabled = true;
        $this->google2fa_secret = $secret;
        $this->save();
    }

    public function disableTwoFactorAuth()
    {
        $this->google2fa_enabled = false;
        $this->google2fa_secret = null;
        $this->save();
    }
}
