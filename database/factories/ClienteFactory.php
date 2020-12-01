<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                //'id'=>$this->faker->randomDigit,
                'nome'=> $this->faker->unique()->name,
                'cpf'=> $this->faker->regexify('[0-9]{' . mt_rand(12,12) . '}'),
            ];

    }
}
