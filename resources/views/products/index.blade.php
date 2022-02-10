@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col"><h1>Produtos</h1></div>
        <div class="col">
            <div class="dropdown float-right">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  Importar produtos
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/importar-produtos-bling">Bling</a>
                </div>
              </div>
        </div>
    </div>
@stop

@section('content')

@include('layouts.info_message')

    <div class="container-fluid">
        
    </div>
 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop