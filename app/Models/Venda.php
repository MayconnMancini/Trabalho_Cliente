<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany("App\Models\Produto");
    }


}
