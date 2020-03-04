<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\PhotoGallery;
use App\User;
use Carbon\Carbon;

class autoPhotoOrdersDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DeleteOrder:autoPhotoOrdersDelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = Order::whereNull('size_id')->whereMonth('created_at', '<', date('m'))->get();
        //  $result = PhotoGallery::whereMonth('created_at', '<', date('m'))->get();
        // $result = Order::whereNull('trx')->whereNull('size_id')->where('created_at', '>=', Carbon::now()->subMonth())->get();
        foreach($result as $key => $x){
            echo "Orders ID: ".$x->orders_id."\n";

            $order = Order::where('orders_id', $x->orders_id)->get();
            $photoOrder = Order::whereNull('size_id');

                if($photoOrder){
                    $order = PhotoGallery::where('order_id', $id)->get();
                        foreach ($order as $order){
                            @unlink('assets/upload/gallery/'. $order->images);
                            $order->delete();
                            }
                    }
        }
        echo count($result);
        //dd($result->orders_id, $result->trx, $result->user_id,$result->phone);
        

        





            // $order = Order::where('orders_id', $id)->get();
            // $photoOrder = Order::whereNull('size_id');

            //     if($photoOrder){
            //         $order = PhotoGallery::where('order_id', $id)->get();
            //             foreach ($order as $order){
            //                 @unlink('assets/upload/gallery/'. $order->images);
            //                 $order->delete();
            //                 }
            //         }

    
    }
}
