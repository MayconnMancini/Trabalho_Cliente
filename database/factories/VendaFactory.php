<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;

class VendaFactory extends Factory
{
    protected $model = Venda::class;

    public function definition()
    {

        return [
            'nomeVendedor'=> $this->faker->unique()->name,
            'valorTotal' => 0,
            'cliente_id' => Cliente::factory(),
            'data'=>now()
            //'data','nomeVendedor','valorTotal','cliente_id'*/
        ];
    }
}
