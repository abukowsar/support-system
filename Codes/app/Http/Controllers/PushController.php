<?php

namespace App\Http\Controllers;

use App\Notifications\CommonNotification;
use App\Notifications\TicketWasOpenedByCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PushController extends Controller
{
    /**
     * Store the PushSubscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        if(auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();
        } else {
            $user = auth()->user();
        }

        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true], 200);
    }

    /**
     * Send Push Notifications to all users.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function push()
    {

        if(auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();
        } else {
            $user = auth()->user();
        }

        Notification::send($user, new CommonNotification('open_ticket', ['name' => 'TEST', 'ticket' => 'TEST']));

        return redirect()->back();
    }
}
