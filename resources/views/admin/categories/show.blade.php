@extends('admin.layouts.app')

@section('title', 'Ver Categoria')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Categoria</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('category.index') }}">Categoria</a></li>
                <li class="breadcrumb-item active">Categorias</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">

                        <a href="{{ route('category.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listar</a>
        
        
                        <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-warning btn-sm me-1"><i
                                class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                
                    <form method="POST" id="formDelete{{ $category->id}}" action="{{ route('category.destroy', ['category' => $category->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete" data-delete-id="{{$category->id}}"><i
                                class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>
        
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $category->id }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $category->name }}</dd>

                </dl>
            </div>
        </div>
    </div>
@endsection
