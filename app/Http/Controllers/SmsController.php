<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsRequest;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{

    public function sendSms(SmsRequest $request)
    {
        Nexmo::message()->send([
            'to'   => $request->mobile,
            'from' => '46732635258',
            'text' => 'Test sms',
        ]);

        return redirect()->back()->with('message', 'Sms was sent');
    }

    public function indexSms()
    {
        return view('sendSms');
    }

}
