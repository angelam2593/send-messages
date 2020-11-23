<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\TrioptimaMail;
use App\Models\EmailMessage;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

            $this->saveEmail(false, $request, true);
            Log::error($exception);

            return redirect()->back()->with('error', 'Email failed to be sent');
        }
    }


    public function saveEmail($status, $request, $exception = null)
    {
        $newMessage       = new Message();
        $newMessage->type = 'email';
        $newMessage->save();

        $newMail                  = new EmailMessage();
        $newMail->recipient_email = $request->email;
        $newMail->content         = $request->emailContent;
        $newMail->subject         = $request->subject;
        $newMail->recipient_cc    = $request->cc_recipient;
        $newMail->recipient_bcc   = $request->bcc_recipient;
        $newMail->sent_at         = Carbon::now();
        $newMail->error           = $exception;
        $newMail->message_id      = $newMessage->id;
        $newMail->save();
    }


    public function indexEmail()
    {
        return view('sendEmail');
    }


    public function listAllEmailMessages()
    {
        $messages = EmailMessage::paginate(5);

        return view('listEmailMessages')->with('messages', $messages);

    }


    public function listFetchedEmailMessages()
    {
        $messages = EmailMessage::whereNull('error')->paginate(5);

        return view('listEmailMessages')->with('messages', $messages);
    }


    public function listFailedEmailMessages()
    {
        $messages = EmailMessage::whereNotNull('error')->paginate(5);

        return view('listEmailMessages')->with('messages', $messages);
    }


    public function deleteMail(Request $request)
    {
        if (!isset($request->all()['mailsToDelete'])) {
            return redirect()->back()->with('error', 'No selected e-mail messages to delete');
        }

        $mailsToDelete = $request->all()['mailsToDelete'];
        foreach ($mailsToDelete as $id) {
            $mail = EmailMessage::findOrFail($id);
            Message::findOrFail($mail->message_id)->delete();
            $mail->delete();
        }

        $messages = EmailMessage::paginate(5);

        return view('listEmailMessages')->with('messages', $messages);
    }
}
