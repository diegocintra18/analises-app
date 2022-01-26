<?php

namespace App\Http\Controllers\Irroba;

use App\Http\Controllers\Controller;
use App\Models\Integrations\Integrations;
use App\Models\Irroba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IrrobaController extends Controller
{
    public function store(Request $request){

        $post = $request->all();
        $user = Irroba::select()->first();

        if ($user == NULL ){
            if( $this->validateUserIrroba($post) == TRUE ) {
            
                Irroba::create([
                    'user' => $post["user"], 
                    'password' => $post["password"]
                ]);

                $this->getAuthIrroba();

                $integration = new Integrations();
                $integration->saveIntegration('Irroba');
    
                return redirect()->back()->with('message', "Usuário e senha salvos com sucesso!");
                
            } else {
                return redirect()->back()->with('error', "Usuário ou senha incorretos, corrija os dados e tente novamente!");
            }
        } else {
            return redirect()->back()->with('error', 'Já existe uma integração com a Irroba cadastrada!');
        }

    }

    public function validateUserIrroba($key){

        // Está função valida se o usuário e senha informados estão corretos realizando um request na api da Irroba para obter um authorization

        $user = $key['user'];
        $senha = $key['password'];
        
        $response = Http::post('https://api.irroba.com.br/v1/getToken',[
            'username' => $user,
            'password' => $senha
        ]);

        $data = json_decode($response, TRUE);

        if($data["success"] == "true"){
           return TRUE;
        }else{
            return FAlSE;
        }

    }

    public function getAuthIrroba(){

        // Esta função obtém um novo Authorization na API da Irroba E-commerce, este
        // authorization é necessário para realizar autenticação para requisições
        // esta função verifica se já existe um auth no banco válido, se houver ela retorna o mesmo
        // caso não exista ela irá gerar um novo, e atualizar o registro existente
        
        $user = Irroba::select('authorization', 'updated_at')
                ->where('id', 1)
                ->get();
        
        $data = json_decode($user, TRUE);
        
        if( empty($data) ){
            
            // obtém do banco os dados de acesso
            $key = $this->getUserPassIrroba();

            // obtém o authtorization
            $authorizationKey = $this->getNewAuthorization($key);
            
            // atualiza o novo authorization no banco
            Irroba::where('id', 1)->update(['authorization' => $authorizationKey]);

        } else {

            $horaAuth = $data[0]["updated_at"];
            $agora = date('Y-m-d H:i:s', time());

            $start = strtotime($horaAuth);
            $end   = strtotime($agora);
            
            $resultado = ($end - $start)/60;

            if( $resultado < 25){

                return $data[0]["authorization"];

            }else{

                // obtém do banco os dados de acesso
                $key = $this->getUserPassIrroba();

                // obtém o authtorization
                $authorizationKey = $this->getNewAuthorization($key);

                // atualiza o novo authorization no banco
                Irroba::where('id', 1)->update(['authorization' => $authorizationKey]);

                return $authorizationKey;
            }
        }
        
    }

    public function getUserPassIrroba(){
        // esta função retorna o user e senha da API Irroba do cliente que é necessário
        // para obter o Authorization
        $user = Irroba::select('user', 'password')
                ->where('id', 1)
                ->get();
        
        $data = json_decode($user, TRUE);

        return $userApi[] = ["user" => $data[0]["user"], "password" => $data[0]["password"]];
    }

    public function getNewAuthorization($user){
        //Está função obtém uma nova autorization

        $response = Http::post('https://api.irroba.com.br/v1/getToken',[
            'username' => $user["user"],
            'password' => $user["password"]
        ]);

        $data = json_decode($response, TRUE);

        if( $data["success"] == "true"){
            return $data["data"]["authorization"];
        }else{
            return redirect()->back()->with('error', "Erro ao se conectar com a API da Irroba E-commerce");
        }
        
    }
}
