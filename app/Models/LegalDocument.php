<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalDocument extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'file_path', 'file_name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
