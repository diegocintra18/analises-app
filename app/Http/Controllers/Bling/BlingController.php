<?php

namespace App\Http\Controllers\Bling;

use App\Http\Controllers\Controller;
use App\Models\Bling;
use App\Models\Integrations\Integrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

            $integration = new Integrations();
            $integration->saveIntegration('Bling - '. $data['account_name']);
            
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
