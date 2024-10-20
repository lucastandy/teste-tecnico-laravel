<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'status';

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'name'
    ];
}
