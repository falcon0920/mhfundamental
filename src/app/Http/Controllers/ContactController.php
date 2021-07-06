<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function index()   //コンタクトフォームを表示
    {
        return view('contact.index');
    }

    public function send(Request $request)  //メールの自動送信設定
    {
        Mail::send('emails.text', [], function($data){
            $data   ->to('送信先のメアド')
                ->subject('送信メールの表題');
        });

        return back()->withInput($request->only(['name']))
            ->with('sent', '送信完了しました。');  //送信完了を表示
    }
}
