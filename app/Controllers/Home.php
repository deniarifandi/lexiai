<?php

namespace App\Controllers;

class Home extends BaseController
{   
    public function index(){
         return view('landing');
    }

    // public function dashboard()
    // {
    //     return view('dashboard/index', [
    //         'title' => 'Dashboard'
    //     ]);
    // }

    public function dashboard(){
        return view('dashboard/index');
    }

    public function readingDashboard(){
        return view('reading_dashboard');
    }

    public function readingTest(){
        return view('reading_test');
    }

    public function readingFeedback(){
        return view('reading_feedback');
    }

}
