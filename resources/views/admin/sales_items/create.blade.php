@extends('admin.layouts.app')

@section('title', 'Adicionar Item a Venda')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Continuar Venda</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('sale.index') }}">Vendas</a>
                </li>
                <li class="breadcrumb-item active">Venda</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Cadastro de Venda</span>
                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('sale.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('sale_item.store') }}" method="POST" class="row g-3">
                    @csrf

                    <input type="hidden" name="code_sale" id="code_sale" value="{{ $sale_items->first()->code_sale }}">


                    <div class="col-5">
                        <label for="produto_id" class="form-label">Escolha um Produto: </label>
                        <select name="produto_id" id="produto_id" class="form-select">
                            <option value="">Selecione um produto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->sale_price }}"
                                    data-quantity="{{ $product->stock_quantity }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">
                        <label for="quantity" class="form-label">Preço de Venda: </label>
                        <input type="text" name="sale_price" placeholder="Preço de Venda" id="sale_price"
                            class="form-control" readonly>
                    </div>

                    <div class="col-3">
                        <label for="qtd_desejada" class="form-label">Quantidade desejada: </label>
                        <input type="number" name="qtd_desejada" id="qtd_desejada" class="form-control"
                            placeholder="Quantidade" value="{{ old('qtd_desejada') }}">
                    </div>

                    <div class="col-2">
                        <label for="total" class="form-label">Total </label>
                        <input type="text" placeholder="Total" name="total" id="total" class="form-control"
                            readonly>
                    </div>
                    <div id="quantity_alert" class="alert alert-danger" style="display: none;">Quantidade indisponível!
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>

                </form>

            </div>

        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Itens da Venda</span>
                <span class="ms-auto d-sm-flex flex-row">
                </span>
            </div>
            <div class="card-body">

                <h2 class="mt-3 text-center">Valor Total da Compra: {{ 'R$ ' . number_format($totalVenda, 2, ',', '.') }}
                </h2>
                <h5>Código da venda: {{ $sale_items->first()->code_sale }}</h5>
                <h5>Cliente: {{ $sale->customer->name }}</h5>

                <br>

                
                    <div class="row">
                        <div class="col-8">
                            {{-- Criando um formulário para cada item --}}
                            <form action="{{ route('sale_completed.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total_venda" id="total_venda" value="{{ $totalVenda }}">
                                <input type="hidden" name="code_sale" id="code_sale" value="{{ $sale_items->first()->code_sale }}">
                                @php
                                    $contador_linha = 0;
                                @endphp
                                @forelse ($sale_items as $item)
                                    <div class="row @if ($contador_linha != 0) mt-1 @endif">
                                        <div class="col">
                                            @if ($contador_linha == 0)
                                                <label for="produto_id" class="form-label">Produto </label>
                                            @endif
                                            <input type="text" class="form-control"
                                                name="produto_id{{ $contador_linha }}" id="produto_id"
                                                value="{{ $item->product->name }}" readonly>
                                        </div>
                                        <div class="col">
                                            @if ($contador_linha == 0)
                                                <label for="preco_venda" class="form-label">Preço de Venda </label>
                                            @endif
                                            <input type="text" class="form-control"
                                                name="preco_venda{{ $contador_linha }}" id="preco_venda"
                                                value="{{ $item->unit_price }}" readonly>
                                        </div>
                                        <div class="col">
                                            @if ($contador_linha == 0)
                                                <label for="quantidade" class="form-label">Quantidade </label>
                                            @endif
                                            <input type="text" class="form-control"
                                                name="quantidade{{ $contador_linha }}" id="quantidade"
                                                value="{{ $item->quantity }}" readonly>
                                        </div>
                                        <div class="col">
                                            @if ($contador_linha == 0)
                                                <label for="total_item" class="form-label">Total Item </label>
                                            @endif
                                            <input type="text" class="form-control"
                                                name="total_item{{ $contador_linha }}" id="total_item"
                                                value="{{ $item->unit_price * $item->quantity }}" readonly>
                                        </div>

                                    </div>
                                    @php
                                        $contador_linha++;
                                    @endphp
                                @empty
                                    <div class="alert alert-danger">Nenhum item encontrado</div>
                                @endforelse

                                <div class="row mt-4">
                                <input type="hidden" name="applied_code" value="0" id="applied_code">
                                <input type="hidden" name="coupon_id_applied" id="coupon_id_applied" value="0">
                                    <div class="col">
                                        <label for="coupon_id" class="form-label">Aplicar Cupom </label>
                                        <select name="discount_value" id="coupon_id" class="form-select">
                                            <option value="0">Nenhum cupom aplicado</option>
                                            @foreach ($coupons as $coupon)
                                                <option value="{{ $coupon->discount }}" data-coupon_id="{{ $coupon->id }}"
                                                    {{ old('coupon_id') == $coupon->id ? 'selected' : '' }}>
                                                    {{ $coupon->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-3 mt-4">
                                        <button type="submit" class="btn btn-success mt-2">Finalizar Venda</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @php
                            $contador_linha = 0;
                        @endphp
                        <div class="col-4">
                            @forelse ($sale_items as $item)
                                <form method="POST" id="formDelete{{ $item->id }}" class="mt-2"
                                    action="{{ route('sale_item.destroy', ['id' => $item->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" @if ($contador_linha == 0) id="delete_item_compra" @endif
                                        class="btn btn-danger btn-sm me-1 mb-1 btnDelete @if ($contador_linha == 0) mt-4 @else mt-1 @endif"
                                        data-delete-id="{{ $item->id }}"><i class="fa-regular fa-trash-can"></i>
                                        Apagar</button>
                                </form>
                                @php
                                    $contador_linha++;
                                @endphp
                            @empty
                            @endforelse
                        </div>

                    </div>

                


            </div>

        </div>
    </div>
@endsection
