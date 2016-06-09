<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use DateTime;
class CourseController extends Controller
{

    public function get_four_courses(){
        $courses = DB::table('courses')->take(4)->get();
        return $courses;
    }

    public function get_all_courses(){
        $courses = DB::table('courses')->get();
        return $courses;
    }
}

