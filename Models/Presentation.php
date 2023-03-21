<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_name',
        'client_type',
        'location',
        'size',
        'budget',
        'requirements',
        'properties'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
