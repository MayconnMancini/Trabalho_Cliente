<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['nome','cpf'];

    public function vendas()
    {
        return $this->hasMany("App\Models\Venda");
    }
}
