<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\TrioptimaMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{

    public function sendEmail(MailRequest $request)
    {
        $details = [
            'subject' => $request->subject,
            'content' => $request->emailContent,
            'cc'      => $request->cc_recipient,
            'bcc'     => $request->bcc_recipient,
            'sent_at' => Carbon::now(),
        ];

        // if cases za cc i bcc
        Mail::to($request->email)->send(new TrioptimaMail($details));

        return redirect()->back()->with('message', 'Email was sent');
    }


    public function indexEmail()
    {
        return view('sendEmail');
    }
}
