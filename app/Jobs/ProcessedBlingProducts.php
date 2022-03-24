<?php

namespace App\Jobs;

use App\Http\Controllers\Products\ProductsController;
use App\Models\Products\Products;
use App\Models\Products\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProcessedBlingProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tries = 1;
    protected $code;
    protected $name;
    protected $price;
    protected $cost_price;
    protected $image_url;
    protected $status;
    protected $type;
    protected $stock;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(stdClass $productObject)
    {
        $this->code = $productObject->code;
        $this->name = $productObject->name;
        $this->price = $productObject->price;
        $this->cost_price = $productObject->cost_price;
        $this->image_url = $productObject->image_url;
        $this->status = $productObject->status;
        $this->type = $productObject->type;
        $this->stock = $productObject->stock;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  
        $client = new \GuzzleHttp\Client();

        if( DB::table('products')->where('sku', $this->code)->exists() ){
            Products::where('sku', $this->code)->update([
                'name' => $this->name,
                'price' => $this->price,
                'coast_price' => $this->cost_price,
                'image_url' => $this->image_url,
                'status' => $this->status,
                'type' => $this->type
            ]);

        } else {
           $data = Products::create([
                'sku' => $this->code,
                'name' => $this->name,
                'price' => $this->price,
                'coast_price' => $this->cost_price,
                'image_url' => $this->image_url,
                'status' => $this->status,
                'type' => $this->type
            ]);

            Stock::create([
                'disponibility' => $this->stock,
                'product_id' => $data->id
            ]);
        }

    }
}
