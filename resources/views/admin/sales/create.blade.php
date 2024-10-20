@extends('admin.layouts.app')

@section('title', 'Criar Venda')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Iniciar Venda</h2>
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

                <form action="{{ route('sale.store') }}" method="POST" class="row g-3">
                    @csrf

                    
                        <div class="col-12">
                            <label for="name" class="form-label">Escolha o Cliente: </label>
                            <select name="customer_id" id="customer_id" class="form-select">
                                <option value="">Selecione o cliente</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }} -
                                        {{ $customer->cpf }} - {{ $customer->email }}</option>
                                @endforeach
                            </select>
                        </div>            
                    
                        <div class="col-5">
                            <label for="produto_id" class="form-label">Escolha um Produto: </label>
                            <select name="produto_id" id="produto_id" class="form-select">
                                <option value="">Selecione um produto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->sale_price }}" data-quantity="{{ $product->stock_quantity }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">
                            <label for="quantity" class="form-label">Preço de Venda: </label>
                            <input type="text" name="sale_price" id="sale_price" placeholder="Preço de Venda" class="form-control" readonly>
                        </div>

                        <div class="col-3">
                            <label for="qtd_desejada" class="form-label">Quantidade desejada: </label>
                            <input type="number" name="qtd_desejada" id="qtd_desejada" class="form-control" placeholder="Quantidade"
                                value="{{ old('qtd_desejada') }}">
                        </div>

                        <div class="col-2">
                            <label for="total" class="form-label">Total </label>
                            <input type="text" name="total" id="total" placeholder="Total" class="form-control" readonly>
                        </div>
                        <div id="quantity_alert" class="alert alert-danger" style="display: none;">Quantidade indisponível!</div>
                    
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>

                </form>

            </div>
        </div>
    </div>
@endsection
