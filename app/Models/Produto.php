<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'preco', 'estoque'];

    public function variacoes()
    {
        return $this->hasMany(Variacao::class);
    }
}
