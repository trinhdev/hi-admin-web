<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class AutoemailController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function mail() {
    //     $data = [
    //         'name'      => 'HiFPT Admin'
    //     ];
    //     // $template_path = view('emails.config');
    //     // dd($template_path);
    //     Mail::send(['text' => 'emails.welcome'], $data, function ($message) {
    //         // $message->from('oanhltn3@fpt.com.vn', 'HiFPT Admin');
    //         // $message->sender('oanhltn3@fpt.com.vn', 'HiFPT Admin');
    //         $message->to('rafaelmeredith@gmail.com', 'OanhLe');
    //         // $message->cc('khoatb2@fpt.com.vn', 'Khoa');
    //         // $message->bcc('john@johndoe.com', 'John Doe');
    //         // $message->replyTo('john@johndoe.com', 'John Doe');
    //         $message->subject('Auto report');
    //         // $message->priority(3);
    //         // $message->attach('pathToFile');
    //     });

    //     var_dump('Done sending email');
    // }

    function example_mailing() {
        $data = ['name' => 'HiFPT', 'data' => 'Hello world. Welcome to the Laravel and SendGrid SMTP tutorial. Third try of auto email'];
        $user = ['to' => 'rafaelmeredith@gmail.com'];

        $files = [
            public_path('report_attachment/Online_sale_11_2021.xlsx')
        ];

        Mail::send('emails.welcome', $data, function ($message) use ($user, $files) {
            $message->to($user['to']);
            $message->subject('Hello world, third try');

            foreach($files as $file) {
                $message->attach($file);
            }
        });

        echo "Success mailing";
    }
}
