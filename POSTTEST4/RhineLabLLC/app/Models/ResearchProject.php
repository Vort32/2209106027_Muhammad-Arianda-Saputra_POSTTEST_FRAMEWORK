<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'title',
        'reference_code',
        'status',
        'initiated_at',
        'objective',
    ];

    protected $casts = [
        'initiated_at' => 'date',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function records()
    {
        return $this->hasMany(ResearchRecord::class);
    }
}
