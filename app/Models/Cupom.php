<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = "cupons";
    protected $fillable = ['nome', 'codigo_cupom', 'valor_min', 'validade'];
    protected $casts = [
        'validade' => 'date',
    ];
}
