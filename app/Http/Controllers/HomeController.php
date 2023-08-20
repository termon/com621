<?php

namespace App\Http\Controllers;

use App\Models\WelcomeViewModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $model = new WelcomeViewModel(
            $title = "COM621 Fullstack Development",
            $topics = ["PHP", "HTML", "CSS"]
        );
        return view('home.index', [ 'model' => $model ]);

    }

    public function about() 
    {
        return view("home.about");
    }
}
