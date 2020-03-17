<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;

class NotificationController extends Controller
{
    public function get(){
        $notification = Auth::user()->unreadNotifications;
        return $notification;
    }

    public function read(Request $request){
        Auth::user()->unreadNotifications()->find($request->id)->MarkAsRead();
    }

    public function clear(Request $request){
        $user = Auth::user();

        foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
        }
    }
}
