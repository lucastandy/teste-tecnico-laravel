<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'image_path',
        'category_id',
        'cadastrado_por',
    ];

    // Criar relacionamento entre um e muitos
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    // Criar relacionamento entre um e muitos
    public function user()
    {
        return $this->belongsTo(User::class, 'cadastrado_por');
    }
}
