@extends('admin.layouts.app')

@section('title', 'Criar Categoria')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Categoria Produto</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('category.index') }}">Categorias</a>
                </li>
                <li class="breadcrumb-item active">Categoria</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Cadastro de Categoria</span>
                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('category.index') }}" class="btn btn-info btn-sm me-1"><i
                            class="fa-solid fa-list"></i>
                        Listar</a>

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('category.store') }}" method="POST" class="row g-3">
                    @csrf

                    <div class="col-12">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Categoria do produto: </label>
                        <input type="text" name="name" class="form-control" placeholder="Categoria do produto"
                            value="{{ old('name') }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
