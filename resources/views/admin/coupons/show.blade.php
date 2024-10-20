@extends('admin.layouts.app')

@section('title', 'Ver Cupom')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cupom</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('coupon.index') }}">Cupons</a></li>
                <li class="breadcrumb-item active">Cupons</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">

                        <a href="{{ route('coupon.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listar</a>
    
                        <a href="{{ route('coupon.edit', ['coupon' => $coupon->id]) }}" class="btn btn-warning btn-sm me-1"><i
                                class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                
                    <form method="POST" id="formDelete{{ $coupon->id}}" action="{{ route('coupon.destroy', ['coupon' => $coupon->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete" data-delete-id="{{$coupon->id}}"><i
                                class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>
        
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $coupon->id }}</dd>

                    <dt class="col-sm-3">Código: </dt>
                    <dd class="col-sm-9">{{ $coupon->code }}</dd>

                    <dt class="col-sm-3">Percentual de desconto: </dt>
                    <dd class="col-sm-9">{{ number_format($coupon->discount * 100, 2, ',', '.') . ' %' }}</dd>

                    <dt class="col-sm-3">Data de Expiração: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($coupon->expiry_date)->tz('America/Sao_Paulo')->format('d/m/Y') }}
                    </dd>

                </dl>
            </div>
        </div>
    </div>
@endsection
