@extends('admin.layouts.app')

@section('title', 'Perfil Usuário')

@section('content')
    <div class="container-fluid px-4">
        

        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Perfil do Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Perfil do Usuário</li>
            </ol>
        </div>
        <div class="card mb-4 border-light shadow">
            
            <div class="card-header hstack gap-2">

                <span>Perfil Usuário</span>

                <span class="ms-auto d-sm-flex flex-row">
                        <a href="{{ route('dashboard') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <dl class="row">
                    <dt class="col-sm-3">Id</dt>
                    <dd class="col-sm-9">{{$user->id}}</dd>

                    <dt class="col-sm-3">Nome do Usuário</dt>
                    <dd class="col-sm-9">{{$user->name}}</dd>

                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9">{{$user->email}}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
