<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleItems;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleApiController extends Controller
{
    //Criando o metodo show
    public function show($code_sale): JsonResponse
    {
        // Buscando a venda pelo seu code
        $sale = Sale::where('code_sale', $code_sale)->first();
        // Buscando os itens da venda
        $sale_items = SaleItems::with('product')->where('code_sale', $code_sale)->get();
        // Retornando os detalhes da venda
        return response()->json([
            'status' => true,
            'data_venda' => $sale,
            'data_items_venda' => $sale_items
        ], 200);
    }
}
