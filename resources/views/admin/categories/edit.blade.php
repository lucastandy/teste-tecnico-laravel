@extends('admin.layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Categoria</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('category.index') }}">Categoria</a></li>
                <li class="breadcrumb-item active">Editar Categoria</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Editar Categoria</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('category.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                    <form method="POST" id="formDelete{{ $category->id }}"
                        action="{{ route('category.destroy', ['category' => $category->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete"
                            data-delete-id="{{ $category->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>

                </span>
            </div>
            <div class="card-body">
                <x-alert />
                <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Categoria do produto: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Código do cupom"
                            value="{{ old('name', $category->name) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
