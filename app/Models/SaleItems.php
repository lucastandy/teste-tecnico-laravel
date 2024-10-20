<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItems extends Model
{
    use HasFactory, SoftDeletes;

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'code_sale',
        'product_id',
        'quantity',
        'unit_price',
        'status',
        'cadastrado_por'
    ];

    // Criar relacionamento entre um e muitos
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id')->withTrashed();
    }

    // Criar relacionamento entre um e muitos
    public function user()
    {
        return $this->belongsTo(User::class, 'cadastrado_por')->withTrashed();
    }

    // Criar relacionamento entre um e muitos
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'code_sale')->withTrashed();
    }

    // Criar relacionamento entre um e muitos
    public function statusName()
    {
        return $this->belongsTo(StatusModel::class, 'status')->withTrashed();
    }
}
