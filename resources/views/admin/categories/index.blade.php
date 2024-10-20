@extends('admin.layouts.app')

@section('title', 'Lista de Categorias')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Categoria Produto</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Categorias</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Lista de Categorias</span>
                <span class="ms-auto">
                    <a href="{{ route('category.create') }}" class="btn btn-success btn-sm"><i
                            class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="d-md-flex flex-row justify-content-center">

        
                                        <a href="{{ route('category.show', ['category' => $category->id]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>

                                    
                                        <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    

                                    
                                        <form method="POST" id="formDelete{{ $category->id}}" action="{{ route('category.destroy', ['category' => $category->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete" data-delete-id="{{$category->id}}"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhuma categoria encontrada!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $categories->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
