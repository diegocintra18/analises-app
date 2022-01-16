@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Integrações</h1>
@stop

@section('content')

@if(session('error'))
    <div class="col-12">
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if(session('mensage'))
    <div class="col-12">
        <div class="alert alert-success">
            <strong>{{ session('mensage') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<div class="container-fluid">
    <h2>Plataformas de E-commerce</h2>
    <hr/>
    <div class="row">
         <div class="col-4">
             <div class="card">
                 <div class="card-header">
                     <h3>Irroba E-commerce</h3>
                 </div>
                 <div class="card-body">
                     <p class="card-text">Status: <span class="badge badge-pill badge-success">Conectado</span></p>
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#integrationIrroba">
                        Conectar
                      </button>
                     <a href="/irroba/delete" class="btn btn-danger">Desativar</a>
                 </div>
             </div>
         </div>
    </div>
    <h2>ERP's</h2>
    <hr/>
    <h2>Hubs de Marketplaces</h2>
    <hr/>
</div>
 
 <!-- Modal Integrion Irroba -->
<div class="modal fade" id="integrationIrroba" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Irroba E-commerce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Este usuário e senha referem-se ao <strong>usuário API da sua plataforma</strong>, caso não tenha acesso a estes dados pelo painel, solicite o mesmo para o suporte.</p>
                <form action="{{ route('irroba.store') }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-group">
                        <label for="user">Usuário API</label>
                        <input type="text" name="user" class="form-control" id="user">
                    </div>
                    <div class="form-group">
                        <label for="pass">Senha</label>
                        <input type="password" name="password" class="form-control" id="pass">
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop