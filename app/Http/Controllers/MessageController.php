<?php

namespace App\Http\Controllers;

use App\Models\EmailMessage;
use App\Models\Message;
use App\Models\SmsMessage;


class MessageController extends Controller
{

    public function listAllMessages()
    {
        $messages = Message::paginate(2);
        return view('listMessages')->with('messages', $messages);

    }


    public function listFetchedMessages()
    {
        $mm = Message::all();
        $sms = SmsMessage::all()->whereNull('error');
        $mails = EmailMessage::all()->whereNull('error');
        $messages = $sms->merge($mails);


        return view('listMessages')->with('messages', $messages);
    }


    public function listFailedMessages()
    {
        $sms = SmsMessage::all()->whereNotNull('error');
        $mails = EmailMessage::all()->whereNotNull('error');
        $messages = $sms->merge($mails);

        return view('listMessages')->with('messages', $messages);
    }
}
