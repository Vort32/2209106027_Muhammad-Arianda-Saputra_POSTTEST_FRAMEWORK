<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'lead_scientist',
        'mission',
        'established_at',
        'photo_path',
    ];

    protected $casts = [
        'established_at' => 'date',
    ];

    public function projects()
    {
        return $this->hasMany(ResearchProject::class);
    }
}
