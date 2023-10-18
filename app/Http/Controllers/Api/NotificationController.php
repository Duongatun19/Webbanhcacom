<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NotificationController extends Controller
{
    public function get() {
        $notification = Auth::user()->unreadNotifications;
        return $notification;
    }
    public function read(Request $request) {
        Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
        return 'success';
    }
}
