@extends('admin.layouts.app')

@section('title', 'Lista de Produtos')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Produto</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Produtos</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Lista de Produtos</span>
                <span class="ms-auto">
                    <a href="{{ route('product.create') }}" class="btn btn-success btn-sm"><i
                            class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço de Compra</th>
                            <th>Preço de Venda</th>
                            <th>Qtd. Estoque</th>
                            <th>Imagem</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ 'R$ ' . number_format($product->purchase_price, 2, ',', '.') }}</td>
                                <td>{{ 'R$ ' . number_format($product->sale_price, 2, ',', '.') }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td><img src="{{ asset('img/products/' . $product->image_path) }}" width="35" height="35"></td>
                                <td class="d-md-flex flex-row justify-content-center">

        
                                        <a href="{{ route('product.show', ['product' => $product->id]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>

                                    
                                        <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    

                                    
                                        <form method="POST" id="formDelete{{ $product->id}}" action="{{ route('product.destroy', ['product' => $product->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete" data-delete-id="{{$product->id}}"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum produto encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $products->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
