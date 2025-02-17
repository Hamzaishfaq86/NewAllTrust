<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fpt extends Model
{
    use SoftDeletes;
    
    protected $table = 'fpts';
    protected $guarded = [];
    
    protected $dates = ['deleted_at'];
    
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust 'user_id' if the foreign key is named differently
    }
}
