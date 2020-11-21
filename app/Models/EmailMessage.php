<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->belongsToMany('App\Models\Message');
    }

}
