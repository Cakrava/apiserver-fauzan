<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Dosen::class;
    public function definition(): array
    {
        return [
            'nidn2010054' => $this->faker->unique()->numerify('#######'),
            'namalengkap2010054' => $this->faker->name,
            'jenkel2010054' => $this->faker->randomElement(['L', 'P']),
            'tmp_lahir2010054' => $this->faker->city,
            'tgl_lahir2010054' => $this->faker->date,
            'alamat2010054' => $this->faker->address,
            'notelp2010054' => $this->faker->phoneNumber

        ];
    }
}
