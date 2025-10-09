<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_record_id',
        'label',
        'document_type',
        'access_level',
        'storage_path',
    ];

    public function record()
    {
        return $this->belongsTo(ResearchRecord::class, 'research_record_id');
    }
}
