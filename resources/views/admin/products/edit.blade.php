@extends('admin.layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Produto</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.index') }}">Produto</a>
                </li>
                <li class="breadcrumb-item active">Editar Produto</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Editar Produto</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('product.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

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
                <form action="{{ route('product.update', ['product' => $product->id]) }}" enctype="multipart/form-data" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-6">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Nome do Produto:
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Nome do produto"
                            value="{{ old('name', $product->name) }}">
                    </div>

                    <div class="col-6">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Categoria do Produto:
                        </label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">Selecione o nome do produto</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id || $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-4">
                        <label for="purchase_price" class="form-label"><span class="text-danger">*</span> Preço de Compra:
                        </label>
                        <input type="text" name="purchase_price" class="form-control mask_price"
                            placeholder="Informe o preço de compra do produto"
                            value="{{ old('purchase_price', $product->purchase_price) }}">
                    </div>

                    <div class="col-4">
                        <label for="sale_price" class="form-label"><span class="text-danger">*</span> Preço de Venda:
                        </label>
                        <input type="text" name="sale_price" class="form-control mask_price"
                            placeholder="Informe o preço de venda do produto"
                            value="{{ old('sale_price', $product->sale_price) }}">
                    </div>

                    <div class="col-4">
                        <label for="stock_quantity" class="form-label"><span class="text-danger">*</span> Qtd. Estoque:
                        </label>
                        <input type="number" name="stock_quantity" class="form-control"
                            placeholder="Informe a quantidade de estoque do produto"
                            value="{{ old('stock_quantity', $product->stock_quantity) }}">
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label"><span class="text-danger">*</span> Descricão do Produto:
                        </label>
                        <input type="text" name="description" id="description" class="form-control"
                            placeholder="Descricão do produto" value="{{ old('description', $product->description) }}">
                    </div>


                    <div class="form-group col-md-6">
                        <input name="imagem_antiga" type="hidden" value="{{ $product->image_path ?? '' }}">

                        <label><span class="text-danger">*</span> Foto (150x150)</label>
                        <input name="imagem_nova" type="file" id="imagem_nova">
                    </div>
                    <div class="form-group col-md-6">
                        @php
                            $imagem_antiga = $product->image_path
                                ? asset('img/products/'. $product->image_path)
                                : asset('img/products/product_img.png');
                        @endphp
                        <img src="{{ $imagem_antiga }}" alt="Imagem do Produto" id="preview-product" class="img-thumbnail"
                            style="width: 150px; height: 150px;">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
