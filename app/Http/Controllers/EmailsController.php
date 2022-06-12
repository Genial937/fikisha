<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    static public function send_email($message, $url, $subject, $email)
    {
        $data = [
            'message' => $message,
            'url' => $url,
            'subject' => $subject
        ];
        Mail::to($email)->send(new NotificationMail($data));
    }
}