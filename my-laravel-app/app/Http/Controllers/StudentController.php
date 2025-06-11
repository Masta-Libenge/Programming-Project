<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function dashboard()
    {
        // You could load assignments, courses, etc.
        return view('student.dashboard');
    }

    




}

