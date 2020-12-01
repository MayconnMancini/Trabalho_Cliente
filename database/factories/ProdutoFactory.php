<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

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
            'preco'=> $this->faker->randomFloat($nbMaxDecimals=3),
            'estoque'=> $this->faker->randomDigit
        ];
    }
}
