<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Http\Controllers\Controller;
use DB;
class TagController extends Controller
{
    //
    public function get_tag()
    {
        $tags = DB::table('tags')->get();

        return  $tags;
    }
}
