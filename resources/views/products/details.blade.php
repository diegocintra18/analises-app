@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col">
            <h1>{{$product[0]["name"]}}</h1>
        </div>
        <div class="col">
            <div class="dropdown float-right">
                
            </div>
        </div>
    </div>
@stop

@section('content')

@include('layouts.info_message')


<div class="row">
    <div class="container-fluid bg-white">
        <pre>
            
        </pre>
        <p>Código: {{$product[0]["sku"]}}</p>
        <p>Preço: R$ {{$product[0]["price"]}}</p>
        <p>Custo: R$ {{$product[0]["coast_price"]}}</p>
        <p>Margem bruta: <?php  $profit = ($product[0]["coast_price"] / $product[0]["price"]);
                                echo round(($profit*100), 2);?>%</p>
        <p>Estoque total: {{$product[0]["stocks"][0]["disponibility"]}}</p>

        
    </div>
</div> 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop