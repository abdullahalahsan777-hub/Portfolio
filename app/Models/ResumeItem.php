<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', // 'education' or 'experience'
        'title',
        'institution',
        'company',
        'period',
        'grade',
        'description',
        'theme',
        'sort_order',
    ];

    /**
     * Accessor: institution falls back to company if null.
     */
    public function getInstitutionAttribute($value = null)
    {
        return $value ?: ($this->attributes['company'] ?? '');
    }

    /**
     * Accessor: company falls back to institution if null.
     */
    public function getCompanyAttribute($value = null)
    {
        return $value ?: ($this->attributes['institution'] ?? '');
    }
}
