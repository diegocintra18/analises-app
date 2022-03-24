<?php

namespace App\Http\Controllers\Bling;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Integrations\IntegrationsController;
use App\Http\Controllers\Products\ProductsController;
use App\Jobs\ImportBlingProducts;
use App\Jobs\ProcessedBlingProducts;
use App\Models\Bling;
use App\Models\Integrations\Integrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use stdClass;

class BlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function syncProducts(){
        
        //Obtendo API key do Bling
        $data = Bling::select('api_key')->get()->first();
        $apiKey = $data['api_key'];

        $client = new \GuzzleHttp\Client();

        $pagination = 0;
        $i = 1;

        do{

            $baseUrl = 'https://bling.com.br/Api/v2/produtos/page=' . $i . '/json/?apikey=' . $apiKey . '&estoque=S';
            $response = $client->request('GET', $baseUrl, [
                'form_params' => [
                    'tipo' => 'P'
                ]
            ]);
            $data = $response->getBody();
            $products = json_decode($data, TRUE);
    
            if(isset($products["retorno"]["erros"][0]["erro"])){
                $pagination = 1;
            } else {
                $productObject = new stdClass();
                $prods = $products["retorno"]["produtos"];
                
                foreach($prods as $prod){
                    $product = $prod['produto'];
                    
                    $productObject->code = $product['codigo'];
                    $productObject->name = $product['descricao'];
                    $productObject->price = $product['preco'];
                    $productObject->cost_price = $product['precoCusto'];

                    if ( $product['imageThumbnail'] == null ) {
                        $productObject->image_url = "null";
                    } else { 
                        $productObject->image_url = $product['imageThumbnail'];
                    }
                    
                    if($product["situacao"] == "Ativo"){
                        $productObject->status = 1;
                    } else{
                        $productObject->status = 0;
                    }

                    if(isset($product["codigoPai"])){
                        $productObject->type = "variation";
                    } else if(isset($product["variacoes"])){
                        $productObject->type = "father";
                    } else{
                        $productObject->type = "simple";
                    }

                    $productObject->stock = $product["estoqueAtual"];

                    ProcessedBlingProducts::dispatch($productObject);
                }
                
                ++$i;
            }

        } while ($pagination == 0);

        return redirect()->back()->with('mensage', 'A importação de produtos foi iniciada, aguarde alguns instantes para visualizar os mesmos em seu painel');

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
    public function store(Request $request)
    {
        $data = $request->all();
        $key = $data['api_key'];

        $bling = $this->validateBling($key);

        if($bling == TRUE){
            Bling::create($data);

            $integration = new IntegrationsController();
            $name = 'Bling - ' . $data['account_name'];
            
            $integration->saveIntegration($name);
            
            return redirect()->back()->with('message', 'Conexão realizada com sucesso!');
        } else{
            return redirect()->back()->with('error', 'Erro ao realizar a conexão com o Bling, verifique o usuário API e tente novamente!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function validateBling($key){
        $client = new \GuzzleHttp\Client();
        $baseUrl = 'https://bling.com.br/Api/v2/produtos/json/?apikey=' . $key;

        try {
            $response = $client->request('GET', $baseUrl);
            return TRUE;
        } catch (\Exception $e) {
            return FALSE;
        }
    }
}
