@extends('admin.layouts.app')

@section('title', 'Criar Produto')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Produto</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.index') }}">Produtos</a>
                </li>
                <li class="breadcrumb-item active">Produto</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Cadastro de Produto</span>
                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('product.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf

                    <div class="col-6">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Nome do Produto: </label>
                        <input type="text" name="name" class="form-control" placeholder="Nome do produto"
                            value="{{ old('name') }}">
                    </div>

                    <div class="col-6">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Categoria do Produto: </label>
                        <select  name="category_id" id="category_id" class="form-select">
                            <option value="">Selecione o nome do produto</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-4">
                        <label for="purchase_price" class="form-label"><span class="text-danger">*</span> Preço de Compra: </label>
                        <input type="text" name="purchase_price" class="form-control mask_price"
                            placeholder="Informe o preço de compra do produto" value="{{ old('purchase_price') }}">
                    </div>

                    <div class="col-4">
                        <label for="sale_price" class="form-label"><span class="text-danger">*</span> Preço de Venda: </label>
                        <input type="text" name="sale_price" id="sale_price" class="form-control mask_price"
                            placeholder="Informe o preço de venda do produto" value="{{ old('sale_price') }}">
                    </div>

                    <div class="col-4">
                        <label for="stock_quantity" class="form-label"><span class="text-danger">*</span> Qtd. Estoque: </label>
                        <input type="number" name="stock_quantity" class="form-control"
                            placeholder="Informe a quantidade de estoque do produto" value="{{ old('stock_quantity') }}">
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label"><span class="text-danger">*</span> Descricão do Produto: </label>
                        <input type="text" name="description" id="description" class="form-control"
                            placeholder="Descricão do produto" value="{{ old('description') }}">
                    </div>


                    <div class="col-md-6">

                        <label><span class="text-danger">*</span> Imagem (150x150)</label>
                        <input name="imagem_nova" id="imagem_nova" type="file">
                    </div>
                    <div class="col-md-6">
                        <?php
                        $imagem_antiga = 'img/products/product_img.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem do Produto" id="preview-product" class="img-thumbnail"
                            style="width: 150px; height: 150px;">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
