<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10'
        ], [
            'fullname.required' => 'نام و نام خانوادگی الزامی است',
            'email.required' => 'ایمیل الزامی است',
            'email.email' => 'ایمیل معتبر نیست',
            'subject.required' => 'موضوع پیام الزامی است',
            'message.required' => 'متن پیام الزامی است',
            'message.min' => 'پیام باید حداقل ۱۰ کاراکتر باشد'
        ]);

        Contact::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false
        ]);

        return redirect()->route('contact')->with('success', 'پیام شما با موفقیت ارسال شد!');
    }
}