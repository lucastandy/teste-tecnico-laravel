<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    // Definindo a tabela
    protected $table = 'categories';

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'name',
        'cadastrado_por',
    ];
}
