<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'user_id',
        'record_code',
        'classification',
        'status',
        'recorded_at',
        'summary',
        'image_path',
        'approval_status',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'recorded_at' => 'date',
        'approved_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'research_project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(ResearchDocument::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
