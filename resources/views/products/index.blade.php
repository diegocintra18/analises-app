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


<div class="row">
    <div class="container-fluid">
        <div class="">
            @if(isset($products))
                <div class="row">
                    <div class="container-fluid" style="text-align: center; font-size: 1.4em;">
                        <div class="col-3 float-left">
                            <div class="card bg-primary">
                                <div class="card-header">
                                    <span>Total em Estoque</span>
                                </div>
                                <div class="card-body">{{$stock}}</div>
                            </div>
                        </div>
                        <div class="col-3 float-left">
                            <div class="card bg-primary">
                                <div class="card-header">
                                    Total de Produtos
                                </div>
                                <div class="card-body">{{count($products)}}</div>
                            </div>
                        </div>
                        <div class="col-3 float-left">
                            <div class="card bg-success">
                                <div class="card-header">
                                    Custo de estoque
                                </div>
                                <div class="card-body">R$ {{ number_format($cost, 2, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="col-3 float-left">
                            <div class="card bg-success">
                                <div class="card-header">
                                    Valor de venda
                                </div>
                                <div class="card-body">R$ {{ number_format($saleOportunity, 2, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($products as $product)                
                    <div class="col-6 float-left">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-right">
                                    <a href="{{ route('products.details', $product["sku"]) }}">
                                        <button class="btn btn-primary">Editar</button>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        
                                    </div>
                                    <div class="col">
                                        <span>{{ $product["name"]}} </span><br>
                                        <span>Código: {{ $product["sku"] }}</span><br>
                                        <span>Quantidade em estoque: <span class="badge badge-primary"> {{ $product["stocks"][0]["disponibility"] }} unidades</span></span><br>
                                        <span>Valor de venda: <span class="badge badge-success">R$ {{ $product["price"] }} </span></span><br>
                                        <span>Custo: <span class="badge badge-success">R$ {{ $product["coast_price"] }} </span></span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <span>Canais de Venda:</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop