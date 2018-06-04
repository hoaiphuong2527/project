<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RemindMail;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RemindMailController extends Controller
{
    public function send()
    {
        $expired_date = Carbon::now()->addDay(1);
        $orders = Order::expiredOrder($expired_date)->get();

        //Send mail
        foreach($orders as $order)
        {
            Mail::to($order->borrower->email)
                ->send(new RemindMail($order->borrower->username, $order->expired_date));
        }
        return "dsdgs";
    }
}
