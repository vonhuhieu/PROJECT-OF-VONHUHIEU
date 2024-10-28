<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;

class MailController extends Controller
{
    //
    public function mail_test()
    {
        $data = [
            'subject' => 'Test Mail',
            'body' => 'Thành công',
        ];

        try
        {
            $to_email = "vonhuhieu2003@gmail.com";
            Mail::to($to_email)->send(new MailNotify($data));
            return response()->json(['Gửi mail thành công. Vui lòng kiểm tra']);
        }
        catch(Exception $th)
        {
            return response()->json(['Gửi mail thất bại']);
        }
    }
}
