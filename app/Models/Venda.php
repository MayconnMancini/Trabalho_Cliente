<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;
use Produto;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['data','nomeVendedor','valorTotal','cliente_id'];

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }

    public function produtos()
    {
        return $this->belongsToMany("App\Models\Produto")->withPivot('quantidade');
    }

    public function calcularTotal(Collection $itens) {
        
        $total = 0;

        foreach($itens as $i) {
           
            $total = $total + ($i->preco * $i->pivot->quantidade);

        }

        return $total;
    }


}
