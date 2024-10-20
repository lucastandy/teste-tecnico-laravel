@extends('admin.layouts.app')

@section('title', 'Editar Cupom')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cupom</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('coupon.index') }}">Cupons</a></li>
                <li class="breadcrumb-item active">Editar Cupom</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">

                <span>Editar Cupom</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('coupon.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                    <form method="POST" id="formDelete{{ $coupon->id }}"
                        action="{{ route('coupon.destroy', ['coupon' => $coupon->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete"
                            data-delete-id="{{ $coupon->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>

                </span>
            </div>
            <div class="card-body">
                <x-alert />
                <form action="{{ route('coupon.update', ['coupon' => $coupon->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-4">
                        <label for="code" class="form-label"><span class="text-danger">*</span> Código: </label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Código do cupom"
                            value="{{ old('code', $coupon->code) }}">
                    </div>

                    <div class="col-4">
                        <label for="discount" class="form-label"><span class="text-danger">*</span> Percentual de desconto: </label>
                        <input type="number" name="discount" id="discount" class="form-control"
                            placeholder="Percentual de desconto" value="{{ old('discount', $coupon->discount) }}">
                    </div>

                    <div class="col-4">
                        <label for="expires_at" class="form-label"><span class="text-danger">*</span> Data de expiração: </label>
                        <input type="date" name="expires_at" id="expires_at" placeholder="Informe a data de expiração do cupom" class="form-control"  value="{{ old('expires_at', $coupon->expires_at) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
