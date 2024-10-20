@extends('admin.layouts.app')

@section('title', 'Editar Cliente')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cliente</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('coupon.index') }}">Cupons</a></li>
                <li class="breadcrumb-item active">Editar Cliente</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Editar Cliente</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('customer.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                    <form method="POST" id="formDelete{{ $customer->id }}"
                        action="{{ route('customer.destroy', ['customer' => $customer->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete"
                            data-delete-id="{{ $customer->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>

                </span>
            </div>
            <div class="card-body">
                <x-alert />
                <form action="{{ route('customer.update', ['customer' => $customer->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                     <div class="col-12">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome completo"
                            value="{{ old('name', $customer->name) }}">
                    </div>


                    <div class="col-4">
                        <label for="cpf" class="form-label"><span class="text-danger">*</span> CPF: </label>
                        <input type="text" name="cpf" id="cpf" class="form-control"
                            placeholder="CPF do cliente" value="{{ old('cpf', $customer->cpf) }}">
                    </div>

                    <div class="col-4">
                        <label for="email" class="form-label"><span class="text-danger">*</span> E-mail: </label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Melhor e-mail do cliente" value="{{ old('email', $customer->email) }}">
                    </div>

                    <div class="col-4">
                        <label for="phone" class="form-label"><span class="text-danger">*</span> Telefone: </label>
                        <input type="text" name="phone" id="phone" placeholder="Informe o telefone do cliente" class="form-control"  value="{{ old('phone',$customer->phone) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
