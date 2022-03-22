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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span>Posição do ranking: 1ª posição</span>
                        <div class="float-right">
                            <button class="btn btn-warning">Visualizar</button>
                            <button class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="https://img.irroba.com.br/fit-in/600x600/filters:format(webp):fill(fff):quality(95)/fishwayc/catalog/produtos/molinetes/molinete-jimmy-10020191023234724.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col">
                                <span>Molinete Marine Sports Jimmy 100</span><br>
                                <span>Código: JIM-100</span><br>
                                <span>Quantidade em estoque: <span class="badge badge-primary">2 unidades</span></span><br>
                                <span>Valor de venda: <span class="badge badge-primary">R$ 40,00</span></span><br>
                                <span>Vendas nos últimos 7 dias: <span class="badge badge-success">12 pedidos</span></span><br>
                                <span>Faturamento nos últimos 7 dias: <span class="badge badge-success">R$ 280,00</span></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <span>Canais de Venda:</span> <span class="badge badge-danger">Shopee</span> <span class="badge badge-info">Loja Virtual</span> <span class="badge badge-warning">Mercado Livre</span> 
                                <span class="badge badge-danger">B2W</span> <span class="badge badge-warning">Amazon</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop