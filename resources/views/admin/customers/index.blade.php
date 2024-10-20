@extends('admin.layouts.app')

@section('title', 'Lista de Clientes')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cliente</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Lista de Clientes</span>
                <span class="ms-auto">
                    <a href="{{ route('customer.create') }}" class="btn btn-success btn-sm"><i
                            class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td class="d-none d-md-table-cell">{{ $customer->cpf }}</td>
                                <td class="d-none d-md-table-cell">{{ $customer->email }}</td>
                                <td class="d-md-flex flex-row justify-content-center">

        
                                        <a href="{{ route('customer.show', ['customer' => $customer->id]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>

                                    
                                        <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    

                                    
                                        <form method="POST" id="formDelete{{ $customer->id}}" action="{{ route('customer.destroy', ['customer' => $customer->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete" data-delete-id="{{$customer->id}}"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum cliente encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $customers->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
