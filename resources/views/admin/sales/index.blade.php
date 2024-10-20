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
                                <td>{{\Carbon\Carbon::parse($sale->date)->tz('America/Sao_Paulo')->format('d/m/Y')}}</td>
                                <td>{{ 'R$ ' . number_format($sale->total, 2, ',', '.') }}</td>
                                <td>{{ number_format($sale->discount * 100, 2, ',', '.') . ' %' }}</td>
                                <td>
                                    @if ($sale->status == 1)
                                        <span class="badge bg-warning text-dark">Pendente</span>
                                    @else
                                        <span class="badge bg-success">Finalizada</span>
                                    @endif
                                </td>
                                <td class="d-md-flex flex-row justify-content-center">

                                    @if ($sale->status == 1)
                                        <a href="{{ route('sale_item.create', ['code_sale' => $sale->code_sale]) }}"
                                            class="btn btn-info btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-square-plus"></i> Adicionar Itens
                                        </a>
                                    @endif

                                    @if ($sale->status == 2)
                                        <a href="{{ route('sale.show', ['code_sale' => $sale->code_sale]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>
                                    @endif

                                    @if ($sale->status == 1)
                                        <form method="POST" id="formDelete{{ $sale->id}}" action="{{ route('sale.destroy', ['sale' => $sale->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete" data-delete-id="{{$sale->id}}"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    @endif


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
