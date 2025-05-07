<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'direccion' => $this->faker->address,
            'contacto' => $this->faker->phoneNumber,
            'representante_legal' => $this->faker->name,
            'documentos_legales' => 'documento_' . $this->faker->unique()->word . '.pdf',
        ];
    }
}