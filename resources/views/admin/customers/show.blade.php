@extends('admin.layouts.app')

@section('title', 'Ver Cliente')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cliente</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('customer.index') }}">Cliente</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">

                        <a href="{{ route('customer.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listar</a>
        
        
                        <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}" class="btn btn-warning btn-sm me-1"><i
                                class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                
                    <form method="POST" id="formDelete{{ $customer->id}}" action="{{ route('customer.destroy', ['customer' => $customer->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete" data-delete-id="{{$customer->id}}"><i
                                class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>
        
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $customer->id }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $customer->name }}</dd>

                    <dt class="col-sm-3">CPF: </dt>
                    <dd class="col-sm-9">{{ $customer->cpf }}</dd>

                    <dt class="col-sm-3">Telefone: </dt>
                    <dd class="col-sm-9">{{ $customer->phone }}</dd>      

                </dl>
            </div>
        </div>
    </div>
@endsection
