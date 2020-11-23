<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsRequest;
use App\Models\EmailMessage;
use App\Models\Message;
use App\Models\SmsMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $messages = SmsMessage::paginate(5);

        return view('listSmsMessages')->with('messages', $messages);

    }


    public function listFetchedSmsMessages()
    {
        $messages = SmsMessage::whereNull('error')->paginate(5);

        return view('listSmsMessages')->with('messages', $messages);
    }


    public function listFailedSmsMessages()
    {
        $messages = SmsMessage::whereNotNull('error')->paginate(5);

        return view('listSmsMessages')->with('messages', $messages);
    }


    public function deleteSms(Request $request)
    {
        if (!isset($request->all()['smsToDelete'])) {
            return redirect()->back()->with('error', 'No selected SMS messages to delete');
        }

        $smsToDelete = $request->all()['smsToDelete'];
        foreach ($smsToDelete as $id) {
            $mail = SmsMessage::findOrFail($id);
            Message::findOrFail($mail->message_id)->delete();
            $mail->delete();
        }

        $messages = SmsMessage::paginate(5);

        return view('listSmsMessages')->with('messages', $messages);
    }

}
