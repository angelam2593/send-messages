<?php

namespace App\Http\Controllers;

use App\Mail\TrioptimaMail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Test mail',
            'body'  => 'This is the the body',
        ];

        Mail::to('angelamadjirova@gmail.com')->send(new TrioptimaMail($details));
        return 'TrioptimaMail sent';
    }
}
