<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Offshore extends Model
{

    use HasFactory, SoftDeletes;
    protected $guarded = [];

    // Specify the dates for soft deletes
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'selected_adviser_id');
    }
}
