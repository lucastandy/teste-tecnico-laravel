@extends('admin.layouts.app')

@section('title', 'Ver Produto')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Produto</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.index') }}">Produtos</a>
                </li>
                <li class="breadcrumb-item active">Produto</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('product.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>


                    <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                        class="btn btn-warning btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>

                    <form method="POST" id="formDelete{{ $product->id }}"
                        action="{{ route('product.destroy', ['product' => $product->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete"
                            data-delete-id="{{ $product->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">Imagem</dt>
                    <dd class="col-sm-9">
                       <img src="{{ asset('img/products/' . $product->image_path) }}" height="150" width="150">
                    </dd>

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $product->id }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $product->name }}</dd>

                    <dt class="col-sm-3">Categoria: </dt>
                    <dd class="col-sm-9">{{ $product->category->name }}</dd>

                    <dt class="col-sm-3">Preço de Compra: </dt>
                    <dd class="col-sm-9">{{ 'R$ ' . number_format($product->purchase_price, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Preço de Venda: </dt>
                    <dd class="col-sm-9">{{ 'R$ ' . number_format($product->sale_price, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Quantidade disponiível: </dt>
                    <dd class="col-sm-9">{{ $product->stock_quantity }}</dd>

                </dl>
            </div>
        </div>
    </div>
@endsection
