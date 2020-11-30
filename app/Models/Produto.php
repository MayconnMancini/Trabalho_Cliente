<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome','preco','estoque'];

    public function vendas()
    {
        return $this->belongsToMany("App\Models\Venda")->withPivot('quantidade');
    }

    
}
