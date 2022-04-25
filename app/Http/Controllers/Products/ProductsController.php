<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Irroba\IrrobaController;
use App\Models\Products\Products;
use App\Models\Products\Stock;
use Illuminate\Http\Request;
use stdClass;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Este método verifica se existem produtos cadastrados, e retorna uma lista de produtos com informações sobre Estoque, Preço, e etc
        if( Products::first() != null ){
            
            $data = Products::where('type', 'father')
            ->orWhere('type', 'simple')
            ->with('stocks')
            ->get();

            $products = json_decode($data, TRUE);

            $stock = 0;
            $cost = 0;
            $saleOportunity = 0;
            
            foreach($products as $product){
                $stock += $product["stocks"][0]["disponibility"];
                $productCost = $product["coast_price"] * $product["stocks"][0]["disponibility"];
                $cost += $productCost;
                $productPrice = $product["price"] * $product["stocks"][0]["disponibility"];
                $saleOportunity += $productPrice;
            }
            
            return view('products.index', compact('products', 'stock', 'cost', 'saleOportunity'));

        } else {

            return view('products.index');

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(stdClass $prod)
    {
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sku)
    {
        $data = Products::where('sku', '=', $sku)
        ->with('stocks')
        ->get();

        $product = json_decode($data, TRUE);

        $irroba = new IrrobaController();
        $auth = $irroba->getAuthIrroba();

        $client = new \GuzzleHttp\Client();

        $baseUrl = 'https://api.irroba.com.br/v1/product/' . $sku;
        $response = $client->request('GET', $baseUrl, [
            'headers' => [
                'Content-Type'  => 'application/json',
                'authorization' =>  $auth
            ]
        ]);

        $irroba = $response->getBody();

        $products = json_decode($data, TRUE);

        return view('products.details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
