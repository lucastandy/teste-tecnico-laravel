@extends('admin.layouts.app')

@section('title', 'Editar Usuário')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Editar Usuário</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Editar Usuário</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('user.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                    <form method="POST" id="formDelete{{ $user->id }}"
                        action="{{ route('user.destroy', ['user' => $user->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete"
                            data-delete-id="{{ $user->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>

                </span>
            </div>
            <div class="card-body">
                <x-alert />
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nome do usuário" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">E-mail: </label>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="E-mail do usuário" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
