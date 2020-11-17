<?php

namespace App\Http\Controllers;

use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{

    public function sendSms()
    {
        Nexmo::message()->send([
            'to'   => '46732635258',
            'from' => '46732635258',
            'text' => 'Test sms',
        ]);

        return 'Sms was sent';
    }

}
