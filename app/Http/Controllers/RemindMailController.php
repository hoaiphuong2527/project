<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RemindMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RemindMailController extends Controller
{
    public function send()
    {
        $expired_date = Carbon::now()->addDay(1);
        $users = User::where('expired_date','<',$expired_date)->get();
        //Send mail
        foreach($users as $user)
        {
            Mail::to($user->email)
                ->send(new RemindMail($feedback->Name, $feedback->Message));
        }
        
    }
}
