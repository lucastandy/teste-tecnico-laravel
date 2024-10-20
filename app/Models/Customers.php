<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory, SoftDeletes;

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'phone',
        'cadastrado_por',
    ];

    // Criar relacionamento entre um e muitos
    public function user()
    {
        return $this->belongsTo(User::class, 'cadastrado_por');
    }
}
