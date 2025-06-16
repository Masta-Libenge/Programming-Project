<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // 👩‍🎓 Show the student registration form
    public function showStudentRegisterForm()
    {
        return view('auth.register_student');
    }

    // Handle student registration logic
    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'student',
        ]);

        // ✅ Create an empty profile for the student
        $student->profile()->create([]);

        Auth::login($student);

        return redirect('/student/dashboard');
    }

    // 🏢 Show the company (bedrijf) registration form
    public function showBedrijfRegisterForm()
    {
        return view('auth.register_bedrijf');
    }

    // Handle company registration logic
    public function bedrijfRegister(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $bedrijf = User::create([
            'name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'bedrijf',
        ]);

        // ✅ Create an empty profile for the company
        $bedrijf->profile()->create([]);

        Auth::login($bedrijf);

        return redirect()->route('bedrijf.dashboard');
    }
}
