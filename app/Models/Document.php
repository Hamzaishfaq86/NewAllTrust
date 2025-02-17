<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_path',
        'reference',
        'status',
        'member_id',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
