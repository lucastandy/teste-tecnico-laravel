<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sales_coupons';

    // Indicando quais colunas podem ser cadastrada
    protected $fillable = [
        'code_sale',
        'coupon_id'
    ];


    // Criar relacionamento entre um e muitos
    public function coupon()
    {
        return $this->belongsTo(Coupons::class);
    }
    // Criar relacionamento entre um e muitos
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    
}
