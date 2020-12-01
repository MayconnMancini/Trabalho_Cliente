<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venda;

class VendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nomeVendedor'=> $this->faker->unique()->name,
            'valorTotal'=> $this->randomFloat($nbMaxDecimals=3),
            'cliente_id' => $this->rand(1,10),
            'data'=>now()
            //'data','nomeVendedor','valorTotal','cliente_id'*/
        ];
    }
}
