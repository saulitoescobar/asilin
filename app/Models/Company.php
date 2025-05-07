<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'contacto',
        'representante_legal',
    ];

    public function legalDocuments()
    {
        return $this->hasMany(LegalDocument::class);
    }
}