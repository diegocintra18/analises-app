<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use stdClass;

class ImportBlingProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    protected $key;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(stdClass $key)
    {
        $this->key = $key->key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        $pagination = TRUE;
        $i = 1;

        do{

            $baseUrl = 'https://bling.com.br/Api/v2/produtos/page=' . $i . ' /json/?apikey=' . $this->key;
            $response = $client->request('GET', $baseUrl, [
                'form_params' => [
                    'tipo' => 'P'
                ]
            ]);
            $data = $response->getBody();
            $products = json_decode($data, TRUE);
    
            if(isset($products["retorno"]["erros"][0]["erro"])){
                $pagination = FALSE;
            } else{
                $productArray = new stdClass();
                $productArray->data = $products;
                ProcessedBlingProducts::dispatch($productArray);
                ++$i;
            }

            sleep(10);

        } while ($pagination == TRUE);
    }
}
