<?php

namespace App\Jobs;

use App\Http\Controllers\Products\ProductsController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use stdClass;

class ProcessedBlingProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productArray;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(stdClass $productArray)
    {
        $this->product = $productArray->data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->product["retorno"]["produtos"][0];

        foreach($data as $product){
            $data = new ProductsController();

            $prod = new stdClass();
            $prod->code = $product["produto"]["codigo"];
            $prod->name = $product["produto"]["descricao"];
            $prod->price = $product["produto"]["preco"];
            $prod->cost_price = $product["produto"]["precoCusto"];
            $prod->image_url = $product["produto"]["imageThumbnail"];
            
            if($product["produto"]["situacao"] == "Ativo"){
                $prod->status = 1;
            } else{
                $prod->status = 0;
            }
            
            if(isset($product["produto"]["codigoPai"])){
                $prod->type = "variation";
            } else if(isset($product["produto"]["variacoes"])){
                $prod->type = "father";
            } else{
                $prod->type = "simple";
            }

            $data->store($prod);
        }
    }
}
