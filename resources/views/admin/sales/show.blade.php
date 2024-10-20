@extends('admin.layouts.app')

@section('title', 'Ver Venda')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Venda</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('sale.index') }}">Vendas</a>
                </li>
                <li class="breadcrumb-item active">Venda</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Visualizar</span>
                <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('sale.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <dl class="row">


                    <dt class="col-sm-3">Código da Venda: </dt>
                    <dd class="col-sm-9">{{ $sale->code_sale }}</dd>

                    <dt class="col-sm-3">Cliente: </dt>
                    <dd class="col-sm-9">{{ $sale->customer->name }}</dd>

                    <dt class="col-sm-3">Valor da Venda Total: </dt>
                    <dd class="col-sm-9">{{ 'R$ ' . number_format($sale->total, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Desconto: </dt>
                    <dd class="col-sm-9">{{ number_format($sale->discount * 100, 2, ',', '.') . ' %' }}</dd>

                </dl>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Produto</th>
                            <th>Preço Venda</th>
                            <th>Quantidade</th>
                            <th>Status</th>
                            <th>Total do Item</th>
                        </tr>
                    </thead>
                    
                    <tbody>

                        @forelse ($sale_items as $item)
                            <tr>
                                <td><img src="{{ asset('img/products/' . $item->product->image_path) }}" width="50px"></td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ 'R$ ' . number_format($item->unit_price, 2, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td><span class="badge bg-success">{{ $item->statusName->name  }}</span></td>
                                <td>{{ 'R$ ' . number_format($item->quantity * $item->unit_price, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum item encontrado!</div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
