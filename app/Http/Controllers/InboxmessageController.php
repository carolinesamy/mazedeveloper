<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InboxmessageController extends Controller
{
    //
    public function get_inbox_msg(Request $request)
    {
        $user_id=$request->input('user_id');
        $type=$request->input('type');

        if (session('user_id') == $user_id &&session('type') == $type){


        }

    }
}
