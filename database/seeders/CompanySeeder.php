<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::factory(10)->create();

        // Crear un documento de prueba para cada empresa
        foreach ($companies as $company) {
            $fileName = 'documento_' . $company->id . '.pdf';
            $filePath = 'companiesDocuments/' . $fileName;

            // Generar un archivo PDF de prueba
            Storage::disk('public')->put($filePath, 'Este es un documento de prueba para la empresa ' . $company->nombre);

            // Actualizar el campo documentos_legales con la ruta del archivo
            $company->update(['documentos_legales' => $filePath]);
        }
    }
}