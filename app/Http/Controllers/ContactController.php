<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;

class ContactController extends Controller{

    public function index(){
        return view("contact.index");
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
            'name'     => 'required|min:3',
            'email'   => 'required|email|max:255',
            'message'   => 'required'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        Mail::send('mail.contactTemplate', ['body' => $message], function ($message) use ($name, $email) {
            $message->from("noreply@hackathonstarter.com", $name);
            $message->to("nsegun5@gmail.com")->subject("Message From Hackathon Starter Contact Form - " . $email);
        });

        return redirect('contact')->with('info','Your Message has been sent successfully');
    }

}
