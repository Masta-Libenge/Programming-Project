<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 👩‍🎓 Student registratie
    public function showStudentRegisterForm()
    {
        return view('auth.register_student');
    }

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

        auth()->login($student);
        return redirect('/student/dashboard');
    }

    // 🏢 Bedrijf registratie
    public function showBedrijfRegisterForm()
    {
        return view('auth.register_bedrijf');
    }

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

        auth()->login($bedrijf);
        return redirect()->route('bedrijf.dashboard');
    }
}
