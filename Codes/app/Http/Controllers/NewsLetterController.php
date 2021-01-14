<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    function save(Request $request)
    {	
    	purifyInputData($request);
    	
        $newsletterInfo = Newsletter::updateOrCreate(['email' => $request->email], $request->all());

        $message = _t(__('message.already_subscribed'));
        if($newsletterInfo->wasRecentlyCreated)
            $message = _t(__('message.subscribed'));

        return redirect()->back()->withSuccess(_t($message));
    }
}
