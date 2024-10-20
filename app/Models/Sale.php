<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'code_sale',
        'customer_id',
        'cadastrado_por',
        'date',
        'total',
        'status',
        'discount',
    ];

    // Criar relacionamento entre um e muitos
    public function user()
    {
        return $this->belongsTo(User::class, 'cadastrado_por')->withTrashed();;
    }

    // Criar relacionamento entre um e muitos
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id')->withTrashed();
    }

    // Criar relacionamento entre um e muitos
    public function statusName(){
        return $this->belongsTo(StatusModel::class, 'status');}

}
