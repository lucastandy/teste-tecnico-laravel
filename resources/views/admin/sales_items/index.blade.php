@extends('admin.layouts.app')

@section('title', 'Lista de Vendas')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Venda</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Vendas</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Lista de Vendas</span>
                <span class="ms-auto">
                    <a href="{{ route('sale.create') }}" class="btn btn-success btn-sm"><i
                            class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Código Venda</th>
                            <th>Cliente</th>
                            <th>Data da Venda</th>
                            <th>Valor Total da Venda</th>
                            <th>Desconto</th>
                            <th>Status</th>

                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($sales as $sale)
                            <tr>
                                <td>{{ $sale->code_sale }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->date }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ $sale->discount }}</td>
                                <td>{{ $sale->statusName->name }}</td>
                                <td class="d-md-flex flex-row justify-content-center">

        
                                        <a href="{{ route('sale.show', ['sale' => $sale->id]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>

                                    
                                        <a href="{{ route('sale.edit', ['sale' => $sale->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    

                                    
                                        <form method="POST" action="{{ route('sale.destroy', ['sale' => $sale->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1"
                                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhuma venda encontrada!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $sales->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
