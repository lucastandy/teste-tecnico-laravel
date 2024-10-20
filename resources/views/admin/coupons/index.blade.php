@extends('admin.layouts.app')

@section('title', 'Lista de Cupons')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cupom</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Cupons</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Lista de Cupons</span>
                <span class="ms-auto">
                    <a href="{{ route('coupon.create') }}" class="btn btn-success btn-sm"><i
                            class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Percentual</th>
                            <th>Data de expiração</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td class="d-none d-md-table-cell">{{ number_format($coupon->discount * 100, 2, ',', '.') . ' %' }}</td>
                                <td class="d-none d-md-table-cell">{{\Carbon\Carbon::parse($coupon->expires_at)->tz('America/Sao_Paulo')->format('d/m/Y')}}</td>
                                <td class="d-md-flex flex-row justify-content-center">

        
                                        <a href="{{ route('coupon.show', ['coupon' => $coupon->id]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>

                                    
                                        <a href="{{ route('coupon.edit', ['coupon' => $coupon->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    

                                    
                                        <form method="POST" id="formDelete{{ $coupon->id}}" action="{{ route('coupon.destroy', ['coupon' => $coupon->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete" data-delete-id="{{$coupon->id}}"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum cupon encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $coupons->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
