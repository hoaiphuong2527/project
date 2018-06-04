<?php

namespace App\Console\Commands;

use App\Mail\RemindMail;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class RemindMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:everyDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail remind to users';

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
        $expired_date = Carbon::now()->addDay(1);
        $orders = Order::expiredOrder($expired_date)
                        ->get();
        //Send mail
        foreach($orders as $order)
        {
            Mail::to($order->borrower->email)
                ->send(new RemindMail($order->borrower->username, $order->expired_date));
        }
    }
}
