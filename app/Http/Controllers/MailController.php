<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\TrioptimaMail;
use App\Models\EmailMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{

    public function sendEmail(MailRequest $request)
    {
        $details = [
            'recipient' => $request->email,
            'subject'   => $request->subject,
            'content'   => $request->emailContent,
            'cc'        => $request->cc_recipient,
            'bcc'       => $request->bcc_recipient,
            'sent_at'   => Carbon::now(),
        ];

        try {
            $mail = Mail::to($request->email);
            if ($request->cc_recipient) {
                $mail->cc($request->cc_recipient);
            }
            if ($request->bcc_recipient) {
                $mail->bcc($request->bcc_recipient);
            }
            $mail->send(new TrioptimaMail($details));

            $this->saveEmail(true, $request);

            return redirect()->back()->with('message', 'Email was sent');
        } catch (\Exception $exception) {

            $this->saveEmail(false, $request, $exception);

            return redirect()->back()->with('error', 'Email failed to be sent');
        }
    }


    public function saveEmail($status, $request, $exception = null)
    {
        $newMail                  = new EmailMessage();
        $newMail->recipient_email = $request->email;
        $newMail->content         = $request->emailContent;
        $newMail->subject         = $request->subject;
        $newMail->recipient_cc    = $request->cc_recipient;
        $newMail->recipient_bcc   = $request->bcc_recipient;
        $newMail->sent_at         = Carbon::now();
        $newMail->error           = $exception;
        $newMail->save();
    }


    public function indexEmail()
    {
        return view('sendEmail');
    }
}
