<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    public function smsMessages()
    {
        return $this->hasMany('App\Models\SmsMessage');
    }


    public function emailMessages()
    {
        return $this->hasMany('App\Models\EmailMessage');
    }


    public function getType()
    {
        return $this->type;
    }

}
