<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsRequest;
use App\Models\SmsMessage;
use Carbon\Carbon;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public $trioptimaMobile = '46732635258';


    public function sendSms(SmsRequest $request)
    {
        try {
            Nexmo::message()->send([
                'to'   => $request->mobile,
                'from' => $this->trioptimaMobile,
                'text' => $request->smsContent,
            ]);

            $this->saveSms(true, $request);

            return redirect()->back()->with('message', 'Sms was sent');
        } catch (\Exception $exception) {

            $this->saveSms(false, $request, $exception);

            return redirect()->back()->with('error', 'Sending the SMS failed');
        }
    }


    public function saveSms($status, $request, $exception = null)
    {
        $newSms                   = new SmsMessage();
        $newSms->content          = $request->smsContent;
        $newSms->recipient_mobile = $request->mobile;
        $newSms->sent_at          = Carbon::now();
        $newSms->error            = $status ? null : $exception;
        $newSms->save();
    }


    public function indexSms()
    {
        return view('sendSms');
    }

}
