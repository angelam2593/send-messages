<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsRequest;
use App\Models\EmailMessage;
use App\Models\Message;
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
        $newMessage       = new Message();
        $newMessage->type = 'sms';
        $newMessage->save();

        $newSms                   = new SmsMessage();
        $newSms->content          = $request->smsContent;
        $newSms->recipient_mobile = $request->mobile;
        $newSms->sent_at          = Carbon::now();
        $newSms->error            = $status ? null : $exception;
        $newSms->message_id       = $newMessage->id;
        $newSms->save();
    }


    public function indexSms()
    {
        return view('sendSms');
    }


    public function listAllSmsMessages()
    {
        $messages = SmsMessage::all();

        return view('listSmsMessages')->with('messages', $messages);

    }


    public function listFetchedSmsMessages()
    {
        $messages = SmsMessage::all()->whereNotNull('error');

        return view('listSmsMessages')->with('messages', $messages);
    }


    public function listFailedSmsMessages()
    {
        $messages = SmsMessage::all()->whereNull('error');

        return view('listSmsMessages')->with('messages', $messages);
    }

}
