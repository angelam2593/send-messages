<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\TrioptimaMail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendEmail(MailRequest $request)
    {

        $details = [
            'title' => 'Test mail',
            'body'  => 'This is the the body',
        ];

        Mail::to($request->email)->send(new TrioptimaMail($details));
        return redirect()->back()->with('message', 'Email was sent');
    }


    public function indexEmail()
    {
        return view('sendEmail');
    }
}
